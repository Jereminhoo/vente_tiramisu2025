CREATE OR REPLACE FUNCTION ajout_tiramisu(
    nom_t TEXT,
    description_t TEXT,
    prix_t NUMERIC,
    photo_t TEXT
)
RETURNS INTEGER AS
$$
DECLARE
    id_retour INTEGER;
BEGIN
    SELECT id_tiramisu INTO id_retour FROM tiramisus WHERE nom = nom_t;

    IF FOUND THEN
        RETURN id_retour;
    ELSE
        INSERT INTO tiramisus(nom, description, prix, photo)
        VALUES (nom_t, description_t, prix_t::money, photo_t)
        RETURNING id_tiramisu INTO id_retour;

        RETURN id_retour;
    END IF;
END;
$$ LANGUAGE plpgsql;
