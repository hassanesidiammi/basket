# 🛒 Basket Pricing System

A simple shopping basket system that allows adding products, applying discount rules, and calculating delivery fees. This project follows a clean architecture inspired by Domain-Driven Design (DDD).

## 🚀 Quick Start

### 1. Build the Docker image

```bash
make docker-build
```

### 2. Start the Docker services

```bash
make docker-up
```

### 3. Access the PHP container shell

```bash
make docker-shell
```

## ⚙️ Inside the Container

> Run these commands **after** entering the container with `make docker-shell`.

### Install Composer dependencies

```bash
make install
```

### Run PHPUnit tests

```bash
make tests
```

### Analyze code with PHPStan

```bash
make phpstan
```

### Check code style with PHP_CodeSniffer

```bash
make phpcs
```

## 🧱 Project Structure

```
src/
├── Application/
│   └── BasketApp.php
├── Domain/
│   └── Model/
│       ├── Basket.php
│       └── Product.php
├── Service/
│   ├── Data/
│   │   └── Catalog.php
│   ├── Delivery/
│   │   ├── DeliveryRuleInterface.php
│   │   └── DeliveryRuleSet.php
│   └── Offers/
│       ├── OfferInterface.php
│       └── BuyR01GetOneHalfPrice.php

tests/
└── BasketTest.php
```

## ✨ Business Rules

- `BuyR01GetOneHalfPrice`: For every two `R01` products, the second one is half price.
- Delivery fees:
  - Less than $50 → $4.95
  - Between $50 and $90 → $2.95
  - Over $90 → Free delivery

## 🧪 Test Example

```php
$basket->add('R01')->add('R01')->add('G01');
$this->assertEquals(77.33, $basketApp->total($basket));
```

## 🐳 Key Dependencies

- PHP 8.1
- PHPUnit
- PHPStan
- PHP_CodeSniffer
- Docker

## 📁 Makefile

Useful commands via `make` to automate common tasks. Run `make help` to list all available commands.

## 🧼 Cleanup

Stop Docker services:

```bash
make docker-down
```
