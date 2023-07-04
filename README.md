**Laravel API using Sanctum for Multi Auth**

1) Create Routes In Route/api.php --> set middleware as middleware(['auth:sanctum','abilities:admin']) , if needed.
2) Set guard in Model and In config/auth.php, setup the guard
3) Handle All Exceptions in Exceptions/Handler.php
