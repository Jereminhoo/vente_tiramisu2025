CREATE OR REPLACE FUNCTION ajout_utilisateur(nom_user TEXT,mdp_user TEXT)
RETURNS TEXT AS
'
DECLARE
    utilisateur_existant TEXT;
BEGIN
    SELECT nom INTO utilisateur_existant FROM utilisateurs WHERE nom = nom_user;

    IF utilisateur_existant IS NOT NULL THEN
        RETURN ''Utilisateur déjà existant'';
    ELSE
        INSERT INTO utilisateurs (nom, mdp)
        VALUES (nom_user, mdp_user);
        RETURN ''Utilisateur ajouté avec succès'';
    END IF;
END;
'
LANGUAGE 'plpgsql';
