<!DOCTYPE html>

<html>

    <head>
        <meta charset='utf-8'>
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        
        <!-- Fogli di stile -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/@yield('stile')">
        <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">
        
        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="{{ url('/') }}/js/myScript.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        
        <script type="text/javascript" class="init">

            $(document).ready(function () {

                $('#myTable').DataTable({
                    language: 
                        {
                            "infoFiltered": "(filtrati da _MAX_ elementi totali)",
                            "infoThousands": ".",
                            "loadingRecords": "Caricamento...",
                            "processing": "Elaborazione...",
                            "search": "Cerca:",
                            "paginate": {
                                "first": "Inizio",
                                "previous": "Precedente",
                                "next": "Successivo",
                                "last": "Fine"
                            },
                            "aria": {
                                "sortAscending": ": attiva per ordinare la colonna in ordine crescente",
                                "sortDescending": ": attiva per ordinare la colonna in ordine decrescente"
                            },
                            "autoFill": {
                                "cancel": "Annulla",
                                "fill": "Riempi tutte le celle con <i>%d<\/i>",
                                "fillHorizontal": "Riempi celle orizzontalmente",
                                "fillVertical": "Riempi celle verticalmente"
                            },
                            "buttons": {
                                "collection": "Collezione <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                                "colvis": "Visibilità Colonna",
                                "colvisRestore": "Ripristina visibilità",
                                "copy": "Copia",
                                "copyKeys": "Premi ctrl o u2318 + C per copiare i dati della tabella nella tua clipboard di sistema.<br \/><br \/>Per annullare, clicca questo messaggio o premi ESC.",
                                "copySuccess": {
                                    "1": "Copiata 1 riga nella clipboard",
                                    "_": "Copiate %d righe nella clipboard"
                                },
                                "copyTitle": "Copia nella Clipboard",
                                "csv": "CSV",
                                "excel": "Excel",
                                "pageLength": {
                                    "-1": "Mostra tutte le righe",
                                    "_": "Mostra %d righe"
                                },
                                "pdf": "PDF",
                                "print": "Stampa",
                                "createState": "Crea stato",
                                "removeAllStates": "Rimuovi tutti gli stati",
                                "removeState": "Rimuovi",
                                "renameState": "Rinomina",
                                "savedStates": "Salva stato",
                                "stateRestore": "Ripristina stato",
                                "updateState": "Aggiorna"
                            },
                            "emptyTable": "Nessun dato disponibile nella tabella",
                            "info": "Risultati da _START_ a _END_ di _TOTAL_ elementi",
                            "infoEmpty": "Risultati da 0 a 0 di 0 elementi",
                            "lengthMenu": "Mostra _MENU_ elementi",
                            "searchBuilder": {
                                "add": "Aggiungi Condizione",
                                "button": {
                                    "0": "Generatore di Ricerca",
                                    "_": "Generatori di Ricerca (%d)"
                                },
                                "clearAll": "Pulisci Tutto",
                                "condition": "Condizione",
                                "conditions": {
                                    "date": {
                                        "after": "Dopo",
                                        "before": "Prima",
                                        "between": "Tra",
                                        "empty": "Vuoto",
                                        "equals": "Uguale A",
                                        "not": "Non",
                                        "notBetween": "Non Tra",
                                        "notEmpty": "Non Vuoto"
                                    },
                                    "number": {
                                        "between": "Tra",
                                        "empty": "Vuoto",
                                        "equals": "Uguale A",
                                        "gt": "Maggiore Di",
                                        "gte": "Maggiore O Uguale A",
                                        "lt": "Minore Di",
                                        "lte": "Minore O Uguale A",
                                        "not": "Non",
                                        "notBetween": "Non Tra",
                                        "notEmpty": "Non Vuoto"
                                    },
                                    "string": {
                                        "contains": "Contiene",
                                        "empty": "Vuoto",
                                        "endsWith": "Finisce Con",
                                        "equals": "Uguale A",
                                        "not": "Non",
                                        "notEmpty": "Non Vuoto",
                                        "startsWith": "Inizia Con",
                                        "notContains": "Non Contiene",
                                        "notStarts": "Non Inizia Con",
                                        "notEnds": "Non Finisce Con"
                                    },
                                    "array": {
                                        "equals": "Uguale A",
                                        "empty": "Vuoto",
                                        "contains": "Contiene",
                                        "not": "Non",
                                        "notEmpty": "Non Vuoto",
                                        "without": "Senza"
                                    }
                                },
                                "data": "Dati",
                                "deleteTitle": "Elimina regola filtro",
                                "leftTitle": "Criterio di Riduzione Rientro",
                                "logicAnd": "E",
                                "logicOr": "O",
                                "rightTitle": "Criterio di Aumento Rientro",
                                "title": {
                                    "0": "Generatore di Ricerca",
                                    "_": "Generatori di Ricerca (%d)"
                                },
                                "value": "Valore"
                            },
                            "searchPanes": {
                                "clearMessage": "Pulisci Tutto",
                                "collapse": {
                                    "0": "Pannello di Ricerca",
                                    "_": "Pannelli di Ricerca (%d)"
                                },
                                "count": "{total}",
                                "countFiltered": "{shown} ({total})",
                                "emptyPanes": "Nessun Pannello di Ricerca",
                                "loadMessage": "Caricamento Pannello di Ricerca",
                                "title": "Filtri Attivi - %d",
                                "showMessage": "Mostra tutto",
                                "collapseMessage": "Espandi tutto"
                            },
                            "select": {
                                "cells": {
                                    "1": "1 cella selezionata",
                                    "_": "%d celle selezionate"
                                },
                                "columns": {
                                    "1": "1 colonna selezionata",
                                    "_": "%d colonne selezionate"
                                },
                                "rows": {
                                    "1": "1 riga selezionata",
                                    "_": "%d righe selezionate"
                                }
                            },
                            "zeroRecords": "Nessun elemento corrispondente trovato",
                            "datetime": {
                                "amPm": [
                                    "am",
                                    "pm"
                                ],
                                "hours": "ore",
                                "minutes": "minuti",
                                "next": "successivo",
                                "previous": "precedente",
                                "seconds": "secondi",
                                "unknown": "sconosciuto",
                                "weekdays": [
                                    "Dom",
                                    "Lun",
                                    "Mar",
                                    "Mer",
                                    "Gio",
                                    "Ven",
                                    "Sab"
                                ],
                                "months": [
                                    "Gennaio",
                                    "Febbraio",
                                    "Marzo",
                                    "Aprile",
                                    "Maggio",
                                    "Giugno",
                                    "Luglio",
                                    "Agosto",
                                    "Settembre",
                                    "Ottobre",
                                    "Novembre",
                                    "Dicembre"
                                ]
                            },
                            "editor": {
                                "close": "Chiudi",
                                "create": {
                                    "button": "Nuovo",
                                    "submit": "Aggiungi",
                                    "title": "Aggiungi nuovo elemento"
                                },
                                "edit": {
                                    "button": "Modifica",
                                    "submit": "Modifica",
                                    "title": "Modifica elemento"
                                },
                                "error": {
                                    "system": "Errore del sistema."
                                },
                                "multi": {
                                    "info": "Gli elementi selezionati contengono valori diversi. Per modificare e impostare tutti gli elementi per questa selezione allo stesso valore, premi o clicca qui, altrimenti ogni cella manterrà il suo valore attuale.",
                                    "noMulti": "Questa selezione può essere modificata individualmente, ma non se fa parte di un gruppo.",
                                    "restore": "Annulla le modifiche",
                                    "title": "Valori multipli"
                                },
                                "remove": {
                                    "button": "Rimuovi",
                                    "confirm": {
                                        "_": "Sei sicuro di voler cancellare %d righe?",
                                        "1": "Sei sicuro di voler cancellare 1 riga?"
                                    },
                                    "submit": "Rimuovi",
                                    "title": "Rimuovi"
                                }
                            },
                            "thousands": ".",
                            "decimal": ",",
                            "stateRestore": {
                                "creationModal": {
                                    "button": "Crea",
                                    "columns": {
                                        "search": "Colonna Cerca",
                                        "visible": "Colonna Visibilità"
                                    },
                                    "name": "Nome:",
                                    "order": "Ordinamento",
                                    "paging": "Paginazione",
                                    "scroller": "Scorri posizione",
                                    "search": "Ricerca",
                                    "searchBuilder": "Form di Ricerca",
                                    "select": "Seleziona",
                                    "title": "Crea nuovo Stato",
                                    "toggleLabel": "Includi:"
                                },
                                "duplicateError": "Nome stato già presente",
                                "emptyError": "Il nome è obbligatorio",
                                "emptyStates": "Non ci sono stati salvati",
                                "removeConfirm": "Sei sicuro di eliminare lo Stato %s?",
                                "removeError": "Errore durante l'eliminazione dello Stato",
                                "removeJoiner": "e",
                                "removeSubmit": "Elimina",
                                "removeTitle": "Elimina Stato",
                                "renameButton": "Rinomina",
                                "renameLabel": "Nuovo nome per %s:",
                                "renameTitle": "Rinomina Stato"
                            }
                        }                 
                });
            });
        </script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-1">
            <div class="container">
        
                <a class="navbar-brand" href="{{ route('home') }}">UNIBS <i class="bi bi-pencil-square text-primary" fill="currentColor"></i> NOTES</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @yield('left_navbar')
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @yield('right_navbar')
                    </ul>
                </div>

            </div>
        </nav>
        
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
        
        @yield('corpo')  

    </body>

</html>