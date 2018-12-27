array(6) {
  ["headers"]=>
  object(Requests_Utility_CaseInsensitiveDictionary)#1285 (1) {
    ["data":protected]=>
    array(7) {
      ["date"]=>
      string(29) "Wed, 26 Dec 2018 20:07:03 GMT"
      ["server"]=>
      string(22) "Apache/2.4.18 (Ubuntu)"
      ["vary"]=>
      string(13) "Authorization"
      ["cache-control"]=>
      string(17) "no-cache, private"
      ["access-control-allow-origin"]=>
      string(1) "*"
      ["content-length"]=>
      string(3) "394"
      ["content-type"]=>
      string(16) "application/json"
    }
  }
  ["body"]=>
  string(394) "{"code":500,"status":"AWAIT_REFUND","message":"Encountered an unexpected condition. Dear Customer, you do not have sufficient money on your account. Please add money to your account and try again.","data":{"transaction_id":"1545854811","msisdn":"256704255657","amount":1000,"currency":"UGX","transaction_charge":0,"provider_id":"airtel_money","description":"David Wampamba (Some description)"}}"
  ["response"]=>
  array(2) {
    ["code"]=>
    int(500)
    ["message"]=>
    string(21) "Internal Server Error"
  }
  ["cookies"]=>
  array(0) {
  }
  ["filename"]=>
  NULL
  ["http_response"]=>
  object(WP_HTTP_Requests_Response)#1293 (5) {
    ["response":protected]=>
    object(Requests_Response)#1289 (10) {
      ["body"]=>
      string(394) "{"code":500,"status":"AWAIT_REFUND","message":"Encountered an unexpected condition. Dear Customer, you do not have sufficient money on your account. Please add money to your account and try again.","data":{"transaction_id":"1545854811","msisdn":"256704255657","amount":1000,"currency":"UGX","transaction_charge":0,"provider_id":"airtel_money","description":"David Wampamba (Some description)"}}"
      ["raw"]=>
      string(660) "HTTP/1.1 500 Internal Server Error
Date: Wed, 26 Dec 2018 20:07:03 GMT
Server: Apache/2.4.18 (Ubuntu)
Vary: Authorization
Cache-Control: no-cache, private
Access-Control-Allow-Origin: *
Content-Length: 394
Connection: close
Content-Type: application/json

{"code":500,"status":"AWAIT_REFUND","message":"Encountered an unexpected condition. Dear Customer, you do not have sufficient money on your account. Please add money to your account and try again.","data":{"transaction_id":"1545854811","msisdn":"256704255657","amount":1000,"currency":"UGX","transaction_charge":0,"provider_id":"airtel_money","description":"David Wampamba (Some description)"}}"
      ["headers"]=>
      object(Requests_Response_Headers)#1288 (1) {
        ["data":protected]=>
        array(7) {
          ["date"]=>
          array(1) {
            [0]=>
            string(29) "Wed, 26 Dec 2018 20:07:03 GMT"
          }
          ["server"]=>
          array(1) {
            [0]=>
            string(22) "Apache/2.4.18 (Ubuntu)"
          }
          ["vary"]=>
          array(1) {
            [0]=>
            string(13) "Authorization"
          }
          ["cache-control"]=>
          array(1) {
            [0]=>
            string(17) "no-cache, private"
          }
          ["access-control-allow-origin"]=>
          array(1) {
            [0]=>
            string(1) "*"
          }
          ["content-length"]=>
          array(1) {
            [0]=>
            string(3) "394"
          }
          ["content-type"]=>
          array(1) {
            [0]=>
            string(16) "application/json"
          }
        }
      }
      ["status_code"]=>
      int(500)
      ["protocol_version"]=>
      float(1.1)
      ["success"]=>
      bool(false)
      ["redirects"]=>
      int(0)
      ["url"]=>
      string(32) "https://app.ugmart.ug/api/payout"
      ["history"]=>
      array(0) {
      }
      ["cookies"]=>
      object(Requests_Cookie_Jar)#1286 (1) {
        ["cookies":protected]=>
        array(0) {
        }
      }
    }
    ["filename":protected]=>
    NULL
    ["data"]=>
    NULL
    ["headers"]=>
    NULL
    ["status"]=>
    NULL
  }
}