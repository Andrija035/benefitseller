# BenefitSeller API

BenefitSeller API allows processing transactions made by BenefitSeller cardholders, tracks transaction information, and validates card funds.

### Table of Contents

- [Setup](#setup)
- [Endpoint](#endpoint)

### Setup

1. **Install Dependencies**

    Run command: ```composer install```


2. **Configure Environment Variables**

   Modify the _DATABASE_URL_ variable in the _.env_ file with your database credentials.


3. **Run Database Migrations**

    Run command:

    ```php bin/console doctrine:migrations:migrate```

### Endpoint

* **POST** /api/transaction:
  Process a transaction

  Expected data:

    ```json 
    {
    "cardNumber": "1234567890123456",
    "merchantId": 1,
    "amount": 5000,
    }
    ```
  
    **Request Header Parameters:**

    - `authority` (required)
    - `token` (required)

    **Request Body Parameters:**

    - `cardNumber` (required, string): The 16-digit card number used for the transaction.
    - `merchantId` (required, integer): The merchant ID used for the transaction.
    - `amount` (required, integer): The amount of the transaction.

