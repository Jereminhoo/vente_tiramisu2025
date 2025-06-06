CREATE OR REPLACE FUNCTION get_utilisateur(p_nom VARCHAR, p_mdp VARCHAR)
RETURNS VARCHAR AS 
'
DECLARE
    v_nom VARCHAR;
BEGIN
    SELECT nom INTO v_nom
    FROM Utilisateurs
    WHERE nom = p_nom AND mdp = p_mdp;
    
    IF FOUND THEN
        RETURN v_nom;
    ELSE
        RETURN NULL;
    END IF;
END;
'
LANGUAGE 'plpgsql'; 