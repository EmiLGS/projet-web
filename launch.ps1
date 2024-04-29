Set-Location mysql
docker build -t programming-languages-database .
docker run -d --name programming-languages-database -p 3306:3306 programming-languages-database
Set-Location ..
docker build -t programming-languages .
docker run -d --name programming-languages -p 8080:80 programming-languages