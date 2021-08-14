#Step 2 | API design

##Notes


##Endpoints

----

###Set the forecast for a specific city
Resource allows saving weather forecast for a specific city. In case forecast for date already exist it will be replaced by last one.
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

####Get the weather forecast for a specific city
Endpoint allows getting information about the weather forecast for a specific city. There is a filter available which helps to get the information for concrete day. In case FROM is not defined all available data from today will be returned. In case TO is not defined all available data from specific date (FROM) will be returned. To get  just today's weather forecast you should put today's date in both params (FROM, TO).

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
