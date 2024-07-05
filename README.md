\*\* Documentation

\*\* Installation

After your git clone, you need to install the dependencies:

$ composer install

Then set the dot env file:

$ cp .env.example .env

And edit the .env file to match your environment.
Ensure you have a GEMINI_API_KEY set up

Then run the migrations:

$ php artisan migrate

Use the routes to first register to get a token to use with the API:

/api/v1/auth/register

Then use the token to get communication with the Gemini AI via the API:

api/v1/gemini

NB: This API is only accessible via POSTMAN or similar tools.
