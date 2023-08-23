<?php
require_once '../db.php';

// Obtention des nombres total d'utilisateurs inscrits
$countUsersQuery = "SELECT COUNT(*) AS total_users FROM Utilisateurs";
$stmt = $pdo->prepare($countUsersQuery);
$stmt->execute();
$userCount = $stmt->fetchColumn();

// Obtenir le nombre total de votes pour chaque candidat
$countVotesQuery = "SELECT candidate_id, COUNT(*) AS total_votes FROM Votes GROUP BY candidate_id";
$stmt = $pdo->prepare($countVotesQuery);
$stmt->execute();
$votesPerCandidate = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
    <h1>Bienvenue sur l'espace dédié au candidat</h1>

    <h2>Statistiques</h2>
    <p>Nombre total d'utilisateurs inscrits : <?php echo $userCount; ?></p>

    <h2>Nombre de votes par candidat</h2>
    <?php if (!empty($votesPerCandidate)): ?>
        <ul>
            <?php foreach ($votesPerCandidate as $vote): ?>
                <li>Candidat ID <?php echo $vote['candidate_id']; ?> : <?php echo $vote['total_votes']; ?> votes</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun vote enregistré pour le moment.</p>
    <?php endif; ?>
</body>
</html>
