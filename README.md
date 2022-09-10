## Requirements
-PHP version 7.3<br>
-MSQL version 5.7<br>
-Laravel Version 8<br>

## Laravel Package 
-tymon/jwt-auth (JWT Token Authentication)

## Steps
 -Clone the repository to your working environment<br>
 -Add .env file and setup database connection<br>
 -point to the repository using cmd  & run "composer update"<br>
 -run "php artisan jwt:secret"<br>
 -run "php artisan migrate"<br>
 -run user seeder "php artisan db:seed --class=UserSeeder"<br>
 
 ## API Information
  - **<b>Authenticate User</b><br>
            API     -  http://localhost:8000/api/login<br>
            Method  -  POST
           ![image](https://user-images.githubusercontent.com/26957922/189272716-7e113124-71b7-4083-bcc1-e66ec87c0268.png)
  
  - **<b>Upload PDF</b><br>
           API     -  http://localhost:8000/api/upload-pdf<br>
           Method  -  POST<br>
           NOTE- access_token should be passed as bearer token
           ![image](https://user-images.githubusercontent.com/26957922/189273449-ce5acb53-cd5b-4997-94a1-e7c1f353d42f.png)
           ![image](https://user-images.githubusercontent.com/26957922/189273569-7ad18c43-b1d1-4f43-8bd2-be638009af33.png)
    
    - **<b>User's Uploaded PDF List</b><br>
           API     -  http://localhost:8000/api/user-pdf-list<br>
           Method  -  GET<br>
           NOTE- access_token should be passed as bearer token
           ![image](https://user-images.githubusercontent.com/26957922/189274401-a18eb0d3-03f2-4464-b219-3136b6ca31e5.png)
       
           
            -----Pagination Accepted(10 results each page) - (http://localhost:8000/api/user-pdf-list?page=1)-----
            
            
            Success Response
            ---------------------------
            {
                "status": "success",
                "data": [
                    {
                        "id": 1,
                        "file_name": "1662694897UYOD1_Driving Questions.pdf",
                        "file_type": "pdf",
                        "file_url": "C:\\wamp64\\www\\test-project\\upload-file-api\\storage/pdf\\1662694897UYOD1_Driving Questions.pdf"
                    },
                    {
                        "id": 2,
                        "file_name": "1662699350WezmS_sample-pdf-file.pdf",
                        "file_type": "pdf",
                        "file_url": "C:\\wamp64\\www\\test-project\\upload-file-api\\storage/pdf\\1662699350WezmS_sample-pdf-file.pdf"
                    }
                ]
            }
            
             Error Response
            ---------------------------
           {
            "status": "Token is Invalid"
           }
           
           
  
## Unit Test
-  php artisan test --filter AuthTest
-  php artisan test --filter UploadPdfTest
            
            



           




 
