# hackathon-d8
Hackathon Drupal 8

---------------------
## Pré-requisitos
  * [GIT](https://git-scm.com/)
  * [Docker Compose](https://docs.docker.com/compose/)

---------------------
Clone o projeto
```sh
$ git clone https://github.com/TallerWebSolutions/hackathon-d8.git
$ cd hackathon-d8/
```

---------------------
Para baixar uma imagem pronta, execute esse comando:
```sh
$ docker pull taller/hackataller
```

---------------------
Para entrar na máquina virtual, execute esse comando
```sh
$ docker-compose run --rm -p 8080:80 development
```

  * Depois basta acessa em seu navegador o [http://localhost:8080](http://localhost:8080)
  * As configurações de seu banco de dados estão definidas no docker-compose.yml e são as seguintes:
      - *Host:* drupal-db
      - *Database:* drupal_8
      - *User:* drupal8
      - *User Password:* SenhaDrupal8
      - *Root Password:* SenhaRootDrupal8
