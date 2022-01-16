<?php

class Alerts {

    /* Partie Membre */
    public function waitValidation() {
        echo '<div class="confirm">';
        echo '<span>Votre inscription a bien été prise en compte, vous recevrez prochainement un mail de confirmation</span>';
        echo '<button><a class="button_a" href="../views/accueil.php">Retour à l\'accueil</a></button>';
        echo '</div>';
    }

    public function updateRoleError() {
        echo '<div class="confirm">';
        echo '<span>Erreur dans la mise à jour du rôle de l\'utilisateur, veuillez réessayer</span>';
        echo '<button><a class="button_a" href="../views/gestionnaire_role.php">Retour</a></button>';
        echo '</div>';
    }


    public function mailAlreadyUsed() {
        echo '<div class="confirm">';
        echo '<span>Erreur lors de l\'inscription, l\'adresse mail est déjà associée à un autre compte.</span>';
        echo '<button><a class="button_a" href="../views/signup.php">Retour à l\'inscription</a></button>';
        echo '</div>';
    }


    public function isNotAdmin() {
        echo '<div class="confirm">';
        echo '<span>Erreur : Vous n\'êtes pas autorisé à effectuer cette action</span>';
        echo '<button><a class="button_a" href="../views/accueil.php">Retour à l\'accueil</a></button>';
        echo '</div>';
    }


    public function signupError() {
        echo '<div class="confirm">';
        echo '<span>Une erreur \'est produite, veuillez réessayer.</span>';
        echo '<button><a class="button_a" href="../views/admin_validation.php">Retour à la page de validation</a></button>';
        echo '</div>';
    }

    public function resetPassError() {
        echo '<div class="confirm">';
        echo '<span>Une erreur s\'est produite, veuillez réessayer.</span>';
        echo '<button><a class="button_a" href="../views/forgot_password.php">Retour à la page</a></button>';
        echo '</div>';
    }


    public function wrongIds() {
        echo '<div class="confirm">';
        echo '<span>Erreur : Vos identifiants de connexion sont incorrects, veuillez réessayer.</span>';
        echo '<button><a class="button_a" href="../views/login.php">Retour à la connexion</a></button>';
        echo '</div>';
    }


    public function notSamePass() {
        echo '<div class="confirm">';
        echo '<span>Erreur : Les mots de passes ne correspondent pas, veuillez réessayer.</span>';
        echo '<button><a class="button_a" href="../views/force_change_password.php">Retour</a></button>';
        echo '</div>';
    }


    /* Partie Évènements / Campagnes */

    public function addEventError() {
        echo '<div class="confirm">';
        echo '<span>Erreur dans la création de votre évènement, veuillez réessayer.</span>';
        echo '<button><a class="button_a" href="../views/newEvent.php">Retour</a></button>';
        echo '</div>';
    }

    public function addCampaignError() {
        echo '<div class="confirm">';
        echo '<span>Erreur dans la création de la campagne, veuillez réessayer.</span>';
        echo '<button><a class="button_a" href="../views/newCampaign.php">Retour</a></button>';
        echo '</div>';
    }

    public function campaignAlreadyExist() {
        echo '<div class="confirm">';
        echo '<span>Erreur dans la création de la campagne, car il y en a déjà une en cours.</span>';
        echo '<button><a class="button_a" href="../views/accueil.php">Retour à l\'accueil</a></button>';
        echo '</div>';
    }
}
