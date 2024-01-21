<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ENVIO DE MENSAGEM EM PHP</title>
</head>

<body>
<?

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.positus.global/v2/sandbox/whatsapp/numbers/6334ea09-d3fe-4689-8acb-684eb0d0ec78/messages",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\r\n  \"to\": \"++5585984228226\",\r\n  \"type\": \"text\",\r\n  \"text\": {\r\n      \"body\": \"*VOCE CONSEGUIU*\"\r\n  }\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZmI2NWEyZDhhMDEzNWJmOWFjYmNiNzhiNzA1ZmIxNDkyZWVhZDA3MmY0NWJkOTJkMDQ1ZTNhOTc2ZjU3NDg1MjIxZDlhNWMxYzIyZjJmZjIiLCJpYXQiOjE2MDE3NjgyMjIsIm5iZiI6MTYwMTc2ODIyMiwiZXhwIjoxNjMzMzA0MjIyLCJzdWIiOiIxODEwIiwic2NvcGVzIjpbXX0.WSmAGvHzmqxKU1xagCaV3en4qM5Qk8tDQjfo7ejsWWhokFOn8yHcdzGRAt3OCBgnBDyIa3F4XJNqvwpKH5J67MBt7FipJG7FyX761QJIt-IqLRH-z8B4o_qEtqlXTMkBgshSZudtx5NREPvKZGqZ7dnTCCogw071-yP2Vd9bgYfo-iJFkBHbQnQfH4xCmD7XN8tDBXLoBx1goBbCjwMNV062C-S8ZUC4nKjRRZZjcKlvMSxFzWyCl9x0kUZvavjSZB5BQWJKglfgfEpbKpEQQkiClnFFVxqMGAwZ9ic40cjHAW6uwG3RC1-GapUk-12Qs4g8INGEfhcB8ItyL0SOFwnENavhF8v95sBW2WFAeFAiS5IIZ9b36lxCL1PS03xYh2ErI49MXM-AAPy8i25dZWBhwBVnReOBt9UF-bkzGVopmkgSRDswO0OTKVbKzw9ExVKbxv6KPSKc1xn0gr_BiZIRTklTUR20LVcVxgyGBxn0wu-S7U3TCV4q3jrqy1qMAY6F9GsKVq42riACOFWsH4i-japkEC5hmPiMArWIWGcq7s4lJ8TvBLisU0LMzvvrGp-KfVrG0tv613tDmWI5GRdsf91UdPIhBiBvqo8eN2oyjvOtqriJLsQcgGO4Q7dh-a0OGpJ4KE29ccdLphaYOs6Y75uyE65VDg3YqQO9mN4"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


?>
</body>
</html>