Firstly, thank you for taking time and contributing to the project. All your efforts to contribute are highly appreciated!

## Feature Requests

Feature Requests by the community are highly encouraged. However, please make sure to check that your feature is not already in the [making](https://github.com/gisty-org/gisty-server/pulls). Clearly state why this feature is necessary or why it will be a great addition to the project along with sample use cases to help developers better understand it.

## Reporting an issue

Before submitting an issue please make sure:

- You have read the documentation about the pipeline or function you're trying to use.
- You have already searched for related [issues](https://github.com/gisty-org/gisty-server/issues), and found none open (if you found a related closed issue, please link to it from your post).
- Your issue title is concise, on-topic and polite.
- You can and do provide steps to reproduce your issue.
- For developers, please make sure your environment is setup correctly.

## Workflow for submitting a PR

1. Fork the repository to your own GitHub account

2. Clone from your repository

```bash
  $ git clone https://github.com/your-username/repository-name
```

3. Install the development dependencies

```bash
  $ composer install
```

4. Setup the environment using [.env.example](https://github.com/gisty-org/gisty-server/blob/master/.env.example)

5. Generate an app key and add it to your `.env` file

6. Start the development server

```bash
  $ php artisan serve
```

7. Create a new pull request with an appropriate title, detailed explanation of what the pull request does and attach links to other issues or pull requests related to your pull request

## License

By contributing your code to the Gisty Server GitHub repository, you agree to license your contribution under the [MIT](https://github.com/gisty-org/gisty-server/blob/master/LICENSE) license.
