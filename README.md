# CINAF API STORE 

application to server data for store of cinaf

## Entry point api

| route             | type of response  | details                                | method |
| ----------------- | ----------------- | -------------------------------------- | ------ |
| /softwares        | get all softwares | softwares datas if limited in 10 items | get    |
| /softwares/{page} |                   |                                        | get    |
| /software/{id}    |                   |                                        | get    |
| /software         | update software   |                                        | put    |
| /software         | add software      |                                        | post   |
| /software         | remove software   |                                        | delete |
