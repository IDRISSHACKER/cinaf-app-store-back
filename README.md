# CINAF API STORE 

Api cinaf-app-store

## Entry point api

| route             | type of response  | details                                | method |
| ----------------- | ----------------- | -------------------------------------- | ------ |
| /softwares        | get all softwares | softwares datas if limited in 10 items | get    |
| /softwares/{page} |                   |                                        | get    |
| /software/{id}    |                   |                                        | get    |
| /software         | update software   |                                        | put    |
| /software         | add software      |                                        | post   |
| /software         | remove software   |                                        | delete |


## Configuration

apres le clonage

### Creer la base de donnée

### renomer `.env.dev` en `.env` puis la modifier pour les access à la base de donnée

### importer le fichier SQL depuis la racine du projet
