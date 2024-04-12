# API COVID PLATFORM

Il progetto si occupa della parte di back-end relativa alla piattaforma di visualizzazione ed elaborazione dati riguardo al Covid-19.

In particolare ha il compito di fungere da tramite tra la visualizzazione dei dati (client) e il database vero e proprio, fornendo un'api appositamente sviluppata per il macro progetto.

Il livello di business logic esegue le elaborazioni necessarie dei dati (prelevati dal livello dati) per poi inviarle al livello di presentazione, che si occuperà di mostrarle.

Le API restituiscono un file JSON.

### TECNOLOGIE IMPLEMENTATE

Il progetto è stato sviluppato utilizzando le seguenti tecnologie: PHP

## INSTALLAZIONE

Per eseguire correttamente il progetto è necessario avere installata sulla macchina una versione recente di PHP, per eseguire il progetto da terminale inserire il codice:

  ```
  php -S localhost:8001
  ```

N.B. Il client è strutturato per collegarsi alla porta locale 8001, è quindi consigliabile utilizzare quest'ultima per eseguire le api

Inoltre è necessario avere in esecuzione il database mysql adeguato per il progetto, per info: https://github.com/scio97/databaseUpdaterCovidPlatform

## DOCUMENTAZIONE

| FUNZIONALITA'      | DESCRIZIONE |
| --------- | --- |
| ?mod=ultimo_aggiornamento | Restituisce la data dell’ultimo aggiornamento del database |
| ?mod=box&reg={nomeRegione} | Restituisce i valori di: totale_casi, dimessi_guariti, deceduti, totale_positivi, var_totale_casi, var_deceduti, var_totale_positivi, mortalità. Var_mortalità (var=variazione) dell’ultima data disponibile |
| ?mod=grafico_regioni | Restituisce totale_casi per ogni regione dell’ultima data disponibile |
| ?mod=grafico_totale_casi&reg={nomeRegione} | Restituisce totale_casi per ogni data esistente |
| ?mod=grafico_nuovi_positivi&reg={nomeRegione} | Restituisce totale_positivi di ogni data |
| ?mod=grafico_tamponi&reg={nomeRegione} | Restituisce tamponi di ogni data |
| ?mod=grafico_date | Restituisce tutte le date presenti nel database |
| ?mod=grafico_comparativo&reg={nomeRegione} | Restituisce totale_positivi, dimessi_guariti e deceduti per tutte le date disponibili |
| ?mod=tabella&reg={nomeRegione} | Restituisce tamponi dell’ultima data disponibile, terapia_intensiva, ricoverati_con_sintomi e isolamento_domiciliale delle ultime tre date disponibili e la percentuale delle persone in terapia_intensiva, ricoverati_con_sintomi e isolamento_domiciliale dell’ultima data disponibile |
| ?mod=grafico_provincie&reg={nomeRegione} | Restituisce totale_casi di ogni provincia della regione specificata all’ultima data disponibile |
| ?mod=login&user={nomeUtente}&password={password} | Restituisce “ok” e il tipo di account in caso l’user e la password fossero corretti, altrimenti “passworderr” o “usererr” |
| ?mod=registra&user={nomeUtente}&password{password} | Restituisce true o false in base all’esito della registrazione |
| ?mod=modifica_nazione&data={data}&chiave={chiave}&valore={valore}&user={user} | Modifica il dato specificato e ne tiene traccia sulla tabella “modifiche” |
| ?mod=modifica_regione&data={data}&chiave={chiave}&valore={valore}&user={user} | Modifica il dato specificato e ne tiene traccia sulla tabella “modifiche” |
| ?mod=modifica_provincia&data={data}&valore={valore}&user={user} | Modifica il dato specificato e ne tiene traccia sulla tabella “modifiche” |
| ?mod=cronologia_modifiche | Restituisce tutti i dati presenti nella tabella “modifiche” |
| ?mod=elimina&id={id} | Elimina la tupla con l’id specificato nella tabella “modifiche” |
