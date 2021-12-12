### Build a simple service for helping our customers to manage their spendings

We've been asked by our customers to help them with managing their spendings - they want to know immediately if their total daily spendings go over a specific threshold.

You need to build a service with an API that will be triggered by some other external service that uses OpenBanking. Your API should support the following requests:

1. POST `/threshold` to set up the threshold value for the given user_id,
2. POST `/debit` when a given user_id made a purchase
3. POST `/credit` when a refund happened for the given user_id

Your service should print to the stdout (user_id, threshold, total spendings so far) as soon as it detects overspending.

We love automation and code quality is important to us. While working on the solution please feel free to make needed assumptions.

We anticipate the task should not take more than several hours - it is ok to make some trade-offs. Please do not make your solution available for everyone - that would be unfair to other candidates.


### Assumptions made
- No "User" entity as it's not needed for the main workflow
- Under "threshold" we mean daily threshold. We can set any duration of the threshold. But the system should be modified for this.
- Simplified overspending calculation strategy used
- All the creation command (controller actions) executed without returning IDs of created resource.


### How to run the project
- Install all dependencies with `symfony composer install`
- Run Docker Compose with `make up` or `docker-compose up -d --build` to make PostgreSQL and RabbitMQ running
- Execute migration with `make migrate`
- Launch local web server with Symfony CLI: `symfony serve`
- In another shell start consumer with `symfony console messenger:consume async`
- Execute HTTP requests in `docs/http_requests.http` files and look for messages in console with running consumer