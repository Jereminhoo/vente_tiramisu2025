INSERT INTO utilisateurs(nom, email, mot_de_passe, admin)
VALUES ('Jérémy', 'jeremy', 'anonyme', true);

CREATE OR REPLACE FUNCTION get_admin(login text, password text) RETURNS text
LANGUAGE plpgsql
AS $$
DECLARE
    nom_utilisateur TEXT;
BEGIN
    SELECT nom INTO nom_utilisateur
    FROM administrateurs
    WHERE nom = login AND mdp = password;

    IF FOUND THEN
        RETURN nom_utilisateur;
    ELSE
        RETURN 'ERREUR DE CONNEXION';
    END IF;
END;
$$;
