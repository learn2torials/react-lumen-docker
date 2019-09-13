### React, Lumen, Docker boilerplate

## Requirements
- lumen >= 6
- php >= 7.1
- node >= 12.10

## How to install
```bash
cd src

# install lumen dependencies
composer install

# install react packages
cd resources

# install npm packages
npm install

# run docker
docker-compose up --build -d

# run webpack for live changes
npm run dev
```