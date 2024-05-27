# Descrizione

- Continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo e aggiungiamo una nuova entità Type.

- Questa entità rappresenta la tipologia di progetto ed è in relazione one to many con i progetti.

- I task da svolgere sono diversi, ma alcuni di essi sono un ripasso di ciò che abbiamo fatto nelle lezioni dei giorni scorsi:

1) creare la migration per la tabella types
2) creare il model Type
3) creare la migration di modifica per la tabella projects per aggiungere la chiave esterna
4) aggiungere ai model Type e Project i metodi per definire la relazione one to many
5) visualizzare nella pagina di dettaglio di un progetto la tipologia associata, se presente
permettere all’utente di associare una tipologia nella pagina di creazione e modifica di un progetto
6) gestire il salvataggio dell’associazione progetto-tipologia con opportune regole di validazione

# Bonus 1:
creare il seeder per il model Type.
# Bonus 2:
aggiungere le operazioni CRUD per il model Type, in modo da gestire le tipologie di progetto direttamente dal pannello di amministrazione.