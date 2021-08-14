#Step 2 | API design

##Notes


##Endpoints

----

###Set the forecast for a specific city

* **URL**

  /api/v3/cities/{id}/forecast

* **Method:**

  `POST`

*  **URL Params**

    None

* **BODY**

```json
 [
   {
      "date":"2021-09-15",
      "weather":{
         "condition":{
            "text":"Partly cloudy"
         }
      }
   }
 ]
```

* **Success Response:**

    * **Code:** 204 <br />
      **Content:** `No Content`

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:** `{ error : "City doesn't exist" }`

  OR

    * **Code:** 422 VALIDATION ERROR <br />
      **Content:** `{ error : "Validation Error" }`

* **Sample Call:**

  ```
  POST https://api.musement.com/api/v3/cities/57/forecast
  [
   {
      "date":"2021-09-15",
      "weather":{
         "condition":{
            "text":"Partly cloudy"
         }
      }
   },
   {
      "date":"2021-09-16",
      "weather":{
         "condition":{
            "text":"Partly cloudy"
         }
      }
   },
   {
      "date":"2021-09-17",
      "weather":{
         "condition":{
            "text":"Partly cloudy"
         }
      }
   }
  ]
  ```

####Get the forecast for a specific city

* **URL**

  /api/v3/cities/{id}/forecast

* **Method:**

  `GET`

*  **URL Params**

    * from (Not required)
    * to (Not required)
    ```
      /api/v3/cities/{id}/forecast?from=2021-09-15&to=2021-09-16
    ```

* **BODY**
    None

* **Success Response:**

    * **Code:** 200 <br />
      **Content:** `[
      {
      "date":"2021-09-15",
      "weather":{
      "condition":{
      "text":"Partly cloudy"
      }
      }
      },
      {
      "date":"2021-09-16",
      "weather":{
      "condition":{
      "text":"Partly cloudy"
      }
      }
      },
      {
      "date":"2021-09-17",
      "weather":{
      "condition":{
      "text":"Partly cloudy"
      }
      }
      }
      ]`

* **Error Response:**

    * **Code:** 404 NOT FOUND <br />
      **Content:** `{ error : "City doesn't exist" }`

* **Sample Call:**

  ```
    curl --location --request GET 'https://api.musement.com/api/v3/cities/57/forecast' --header 'Content-Type: application/json'
  ```
