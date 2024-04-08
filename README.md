# BenefitSeller API

BenefitSeller API allows processing and validation of transactions made by BenefitSeller cardholders, tracks transaction information, validates card funds and more!
It gives companies the ability to have multiple groups of employees placed in different categories, each with its own benefit package chosen by the company.

### Table of Contents

- [Setup](#setup)
- [Endpoint](#endpoint)
- [Data Models](#data-models)

### Setup

1. **Install Dependencies**

    Run command: ```composer install```


2. **Configure Environment Variables**

   Modify the _DATABASE_URL_ variable in the _.env_ file with your database credentials.


3. **Create schema**

    Run command:

    ```php bin/console doctrine:database:create```


4. **Run Database Migrations**

    Run command:

    ```php bin/console doctrine:migrations:migrate```


5. **Import dummy data**

    Import _Dump.sql_ into database _benefitseller_.
    
Note that for testing purposes, you'll need to create another database _benefitseller_ and import _TestDump.sql_ into it.
### Endpoint

* **POST** /api/transaction:
  Process a transaction

  Expected data:

    ```json 
    {
    "cardNumber": "4859123456719012",
    "merchantId": 1,
    "amount": 5000,
    }
    ```
  
    **Request Header Parameters:**

    - `authority` (required): "_benefitseller_"
    - `token` (required): "_testvalue_"

    **Request Body Parameters:**

    - `cardNumber` (required, string): The 16-digit number provided by the card during transaction.
    - `merchantId` (required, integer): The merchant ID provided by the merchant during transaction.
    - `amount` (required, integer): The amount of the transaction.

### Data Models

- **Company**:
  Represents a company partnering with BenefitSeller.

- **User**:
  Represents a user of the BenefitSeller platform associated with a company.

- **Transaction**:
  Represents a transaction made by a cardholder.

- **Merchant**:
  Represents a merchant offering benefits and a separate discounts for platinum users.

- **MerchantCategory**:
  Represents a merchant category assigned to a merchant.

- **Package**:
  Represents a package chosen by a company for its employees, possibly containing chosen merchant categories for standard users and singled out merchants for platinum users.

- **Card**:
  Represents a benefit card assigned to a user.

- **Benefit**:
  Represents a benefit offered by a merchant.

- **ApiToken**:
  Represents a token used to confirm the validity of transaction.

Be aware that there are also 2 pivoting tables "package_merchant" (used to link merchants with platinum package cardholders) and "package_merchant_category" (used to link merchant categories with standard package cardholders).
