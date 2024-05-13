<?php
// Avvia una sessione PHP per memorizzare i dati del gioco
session_start();

// Funzione per gestire la richiesta AJAX di registrazione del partecipante
function registerParticipant() {
    if(isset($_POST['name']) && !empty($_POST['name'])) {
        // Ottieni il nome del partecipante dalla richiesta POST
        $name = $_POST['name'];
        
        // Registra il partecipante nella sessione
        $_SESSION['participants'][] = array(
            'name' => $name,
            'score' => 0
        );

        // Restituisci una conferma al client
        echo json_encode(array('success' => true));
    } else {
        // Restituisci un errore se il nome non è stato fornito
        echo json_encode(array('success' => false, 'message' => 'Name is required.'));
    }
}

// Definisci i diversi endpoint del server e associa le relative funzioni
$routes = array(
    'registerParticipant' => 'registerParticipant'
);

// Verifica se la richiesta POST contiene un endpoint valido
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    
    // Esegue la funzione associata all'endpoint
    if(isset($routes[$action])) {
        $routes[$action]();
    } else {
        // Restituisci un errore se l'endpoint non è valido
        echo json_encode(array('success' => false, 'message' => 'Invalid action.'));
    }
} else {
    // Restituisci un errore se l'azione non è stata specificata nella richiesta POST
    echo json_encode(array('success' => false, 'message' => 'Action is required.'));
}
?>
