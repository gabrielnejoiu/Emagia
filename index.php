<?php
require_once('vendor/autoload.php');

use App\Characters\OderusCharacter;
use App\Characters\BeastCharacter;
use App\EmagiaBattle;

if (isset($_POST['attack'])) {
	$Oderus = new OderusCharacter();
	$Beast = new BeastCharacter();
	$Battle = new EmagiaBattle($Oderus, $Beast);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Emagia</title>
    <meta name="description" content="Let the battle begin!">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg">
            <h2 class="text-center p-4 m-0">Emagia</h2>
        </div>
    </div>
	
	<?php // Initial data on game start.
	
	if (!empty($Beast) && !empty($Oderus)):
		?>
        <div class="alert alert-warning" role="alert">
            Players initial stats:
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="card" style="">
                    <div class="card-body">
                        <h5 class="card-title alert-primary" style="padding: 10px 25px; margin: -20px -20px 15px;">
                            ODERUS</h5>
						<?php
						echo $Oderus->showStats();
						?>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="">
                    <div class="card-body">
                        <h5 class="card-title alert-primary" style="padding: 10px 25px; margin: -20px -20px 15px;">
                            BEAST</h5>
						<?php
						echo $Beast->showStats();
						?>
                    </div>
                </div>
            </div>
        </div>

        <div class="spacer p-2"></div>
	
	<?php endif; ?>
	
	<?php
	// Battle loop.
	if (isset($Battle)) {
		while ($Battle->attack()) {
			echo '<div class="alert alert-warning">#' . $Battle->countAttacks . '. ' . $Battle->attacker->name . ' attacks ' . $Battle->defender->name . '</div>';
			?>
            <div class="row">
                <div class="col-sm">
                    <div class="card" style="">
                        <div class="card-body">
                            <h5 class="card-title alert-primary" style="padding: 10px 25px; margin: -20px -20px 15px;">
								<?php echo $Battle->attacker->name; ?></h5>
							<?php
							echo $Battle->attacker->showStats();
							if (!empty($Battle->skillsUsed['attacker']) && is_array($Battle->skillsUsed['attacker'])) {
								echo 'Skills used: ' . implode(',', $Battle->skillsUsed['attacker']);
							}else{
								echo 'No skills were used.';
                            }
							?>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card" style="">
                        <div class="card-body">
                            <h5 class="card-title alert-primary" style="padding: 10px 25px; margin: -20px -20px 15px;">
								<?php echo $Battle->defender->name; ?> had a damage of
                                <strong><?php echo $Battle->damage; ?></strong></h5>
							<?php
							echo $Battle->defender->showStats();
							if (!empty($Battle->skillsUsed['defender']) && is_array($Battle->skillsUsed['defender'])) {
								echo 'Skills used: ' . implode(',', $Battle->skillsUsed['defender']);
							}else{
								echo 'No skills were used.';
							}
							?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="spacer p-2"></div>
			
			<?php
			
		}
		
		if ($Battle->defender->name === 'Oderus') {
			?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading"><?php echo $Battle->defender->name; ?> has lost the fight!</h4>
                        <p>Aww yeah, bad things happen sometimes.</p>
                        <hr>
                        <p class="mb-0">Maybe next time you'll get lucky!</p>
                    </div>
                </div>
            </div>
			<?php
		} else {
			?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading"><?php echo $Battle->defender->name; ?> has lost the fight!</h4>
                        <p>Yeah, well done skipper!</p>
                    </div>
                </div>
            </div>
			<?php
		}
		
		
	}
	?>
	
	
	<?php if (!isset($_POST['attack'])) { ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-secondary">
                    <h2 class="text-center ">Actions</h2>
                    <form class="text-center" name="start" method="post" action="/">
                        <button type="submit" name="attack">Start the attack!</button>
                    </form>
                </div>
            </div>
        </div>
	<?php } ?>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>
</html>
