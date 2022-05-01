# smfony-product
#### Steps to run the application

- clone the project
- enter into the root folder of the application
- please run any one of the below command to run the application
	1. php bin/console server:run 
	2. php -S localhost:8001 -t public

#### Do you want to try with another data file?
- please replace the below files under **PROJECT_ROOT_FOLDER/dataprovider/** 
	1. price.json 
	2. products.xml

we could implement a functionality to auto ingest any file as soon as it arrives or priodically which will be put under this folder.
In case file names and/or path are different from the current configuration then you also need to change the configuration constants.

#### Test cases are still left to run, let's run them.
- php ./bin/phpunit ./tests/Controller/ProductControllerTest.php

#### Endpoints
1. To fetch all products:
   GET http://localhost:8001/products

2. To fetch the product by product id:
	GET http://localhost:8001/products/{productId}
	GET http://localhost:8001/products/BA-01

#### What we can improve?**

- The POST /products endpoint should support the pagination to return limited number of records rather than all at once, believe me it will save resource and would be faster.
- There could be multiple ways to store the data which is somewhere depends on the one or multiple sources to ingest the change delta or complete products on some priodic basis. To keep the things simple i have used Symfony provided cache (because some organizations don't prefer third party caching such as Redis, memcache etc) to store the data with 1 day expiration policy.
- I have written very limited amount of test cases due to time constraint but i usually like more granual level of test along with data validation. In case you feel that i should write them as well then i would be happy to do that.
- I have used the Cache Read through pattern.
- I agree that there are still lots of opportunity to refector & clean the code along with custom exception handling etc.
