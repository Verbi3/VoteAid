import requests

get_questions_api_url = "https://voteaid.000webhostapp.com/Questions/GetQuestionCSV.php?ElectionId=1"
response = requests.get(get_questions_api_url)

# Get the raw questions created by VoteAid users.
lines = str(response.content.decode('utf-8', errors="replace")).split("\n")
questions = []
for line in lines:
    items = line.split(',')
    if items and len(items) > 1 and items[2]:
        questions.append(items[2])

for i in range(len(questions)):
    questions[i] = questions[i].replace('[COMMA]', ',')



print(questions)

# Send the questions to ChatGPT for clean-up, rewrite.
import os
import openai
openai.api_key = os.getenv("OPENAI_API_KEY")

rewrites = []
for question in questions:
    response = openai.Completion.create(
        engine="gpt-3.5-turbo-instruct-0914",
        prompt="Rewrite as a yes-no question to an election candidate:" + question,
        max_tokens=100
    )

    chat_gpt_rewrite = response.choices[0].text.strip()
    chat_gpt_rewrite = chat_gpt_rewrite.replace('"', '')

    if chat_gpt_rewrite:
        rewrites.append(chat_gpt_rewrite)

print(rewrites)

# Dedupe rewritten questions
# Step 1, send each question to ChatGPT API to generate sentence embedding
# Step 2, dedupe the question by checking if similarity score > threshold 0.90 
response = openai.Embedding.create(
    engine="text-embedding-ada-002",
    input=rewrites,
)

rewrite_embeddings = []
for item in response.data:
    print(item.embedding)
    rewrite_embeddings.append(item.embedding)

deduped = []
deduped_embeddings = []

from sklearn.metrics.pairwise import cosine_similarity
import numpy as np

for i in range(len(rewrites)):
    is_duped = False
    for embedding in deduped_embeddings:
        sentence_embedding1 = np.array(embedding)
        sentence_embedding2 = np.array(rewrite_embeddings[i])

        sentence_embedding1 = sentence_embedding1.reshape(1, -1)
        sentence_embedding2 = sentence_embedding2.reshape(1, -1)

        if cosine_similarity(sentence_embedding1, sentence_embedding2)[0] > 0.9:
            is_duped = True
            break
    if is_duped:
        continue
    else:
        deduped.append(rewrites[i])
        deduped_embeddings.append(rewrite_embeddings[i])
    
print(deduped)

# Construct the questionnaire
for i in range(len(deduped)):
    deduped[i] = deduped[i].replace(',', '[COMMA2]')

create_questionnaire_url = "https://voteaid.000webhostapp.com/Questions/CreateQuestionnaire.php?ElectionId=1"
create_questionnaire_url += "&Questions=" + ','.join(deduped)
create_questionnaire_url += "&State=" + 'WA'
create_questionnaire_url += "&ZipCodes=" + '98075'

print(create_questionnaire_url)
response = requests.get(create_questionnaire_url)

if response.status_code == 200:
    print("New questionnaire has been created successfully.")




