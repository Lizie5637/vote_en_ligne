<?php
require_once '../db.php';

// Obtention  des nombres total des votes pour chaque candidat
$countVotesQuery = "SELECT candidate_id, COUNT(*) AS total_votes FROM Votes GROUP BY candidate_id";
$stmt = $pdo->prepare($countVotesQuery);
$stmt->execute();
$votesPerCandidate = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Trouver le candidat avec le plus grand nombre de votes
$winnerCandidate = [];
$maxVotes = 0;
foreach ($votesPerCandidate as $vote) {
    if ($vote['total_votes'] > $maxVotes) {
        $maxVotes = $vote['total_votes'];
        $winnerCandidate = $vote;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
    <h1>Résultats des votes</h1>

    <?php if (!empty($winnerCandidate)): ?>
        <h2>Gagnant : Candidat ID <?php echo $winnerCandidate['candidate_id']; ?></h2>
        <p>Total des votes : <?php echo $winnerCandidate['total_votes']; ?></p>
    <?php else: ?>
        <p>Aucun résultat disponible pour le moment.</p>
    <?php endif; ?>

    <h2>Résultats détaillés</h2>
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
