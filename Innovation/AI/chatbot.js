import OpenAI from "openai";
import dotenv from "dotenv";
dotenv.config(); // Load API key from .env file

const openai = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY, // Use environment variable
});

async function getChatResponse(userMessage) {
  const response = await openai.chat.completions.create({
    model: "gpt-4o-mini",
    messages: [{ role: "user", content: userMessage }],
  });
  return response.choices[0].message.content;
}

// Example Usage
getChatResponse("Hello, how can you help me?").then(console.log);
