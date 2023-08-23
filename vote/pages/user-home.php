<?php
require_once '../db.php';

// Obtention de la liste des candidats depuis la base de données
$query = "SELECT id, name, description FROM Candidats";
$stmt = $pdo->prepare($query);
$stmt->execute();
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Gestion du vote
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $user_id = 1; // Remplacez ceci par l'ID de l'utilisateur (pour la demonstration en locale j'ai mis 1)
    $candidate_id = $_POST['candidate_id'];

    // Insértion des votes dans la base de données
    $insertVoteQuery = "INSERT INTO Votes (user_id, candidate_id) VALUES (:user_id, :candidate_id)";
    $stmt = $pdo->prepare($insertVoteQuery);
    $stmt->execute(['user_id' => $user_id, 'candidate_id' => $candidate_id]);
    $voteSuccessMessage = "Votre vote a été enregistré avec succès.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
    <h1>Bienvenue sur l'espace dédié aux utilisateurs</h1>

    <!-- Afficher la liste des candidats -->
    <h2>Liste des candidats</h2>
    <?php if (!empty($candidates)): ?>
        <ul>
            <?php foreach ($candidates as $candidate): ?>
                <li>
                    <?php echo $candidate['name']; ?> - <?php echo $candidate['description']; ?>
                    <form method="post">
                        <input type="hidden" name="candidate_id" value="<?php echo $candidate['id']; ?>">
                        <button type="submit" name="vote">Voter</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun candidat disponible.</p>
    <?php endif; ?>

    <?php if (isset($voteSuccessMessage)): ?>
        <p><?php echo $voteSuccessMessage; ?></p>
    <?php endif; ?>
</body>
</html>
