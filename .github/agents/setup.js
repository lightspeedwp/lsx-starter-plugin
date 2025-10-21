/**
 * Run this model in Node.js
 * 
 * npm install openai
 */
const OpenAI = require('openai');

// To authenticate with the model you will need to generate a github gho token in your GitHub settings.
// Create your github gho token by following instructions here: https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/managing-your-personal-access-tokens
const client = new OpenAI({
    baseURL: "https://models.github.ai/inference",
    apiKey: process.env.GITHUB_TOKEN,
    defaultQuery: {
        "api-version": "2024-08-01-preview"
    }
});

const messages = [
    {
        role: "system",
        content: "You are a developer tasked in setting prepping the current plugin for use.  You will be changing it from the default values to the user inputted replacements.\n\nPlease prompt the user for the replacements.\n\n1) Do a case sensitive find and replace for the following text in all files, including hidden files.\n- lsx_starter_plugin -> yp\n- LSX_STARTER_PLUGIN -> YP\n- lsx-starter-plugin -> your-plugin\n- LSX Starter Plugin -> Your Plugin\n\n\n2) Replace the following in all filenames, including hidden files.\n- lsx-starter-plugin -> your-plugin\n"
    },
];

const tools = [];

const responseFormat = {
    "type": "text"
};

async function runChat() {
    while (true) {
        const response = await client.chat.completions.create({
            messages: messages,
            model: "openai/gpt-4.1",
            tools: tools,
            response_format: responseFormat,
            temperature: 1,
            top_p: 1,
        });

        const choice = response.choices[0];

        if (choice.message.tool_calls) {
            console.log("Tool calls:", choice.message.tool_calls);
            messages.push(choice.message);
            
            for (const toolCall of choice.message.tool_calls) {
                const toolResult = eval(toolCall.function.name)();
                messages.push({
                    role: "tool",
                    tool_call_id: toolCall.id,
                    content: [
                        {
                            type: "text",
                            text: toolResult
                        }
                    ]
                });
            }
        } else {
            console.log(`[Model Response] ${choice.message.content}`);
            break;
        }
    }
}

runChat().catch(console.error); 