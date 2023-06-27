### **How to run this project**

1\. I used Docker to develop this project. In order to start this project in your locally, you must have [Docker Desktop](https://www.docker.com/products/docker-desktop/) & [Docker-Compose](https://docs.docker.com/compose/install/linux/) installed on your computer. Once, both of them are installed, please navigate inside the root directory and run the below command
```
docker-compose up
```

2\. In order to test the application, please run database migrations inside PHP container so that the required tables and initial data is setup perfectly. In order to run the database migration, please login inside PHP container and run the below command
```
bin/console doctrine:migrations:migrate
```

3\. Once previous steps are executed, please redirect to [http://localhost/api](http://localhost/api) to see the API documentation.


4\. If you face any problems, please let me know. I will be glad to assist. :)