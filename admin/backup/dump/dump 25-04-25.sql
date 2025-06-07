--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2025-04-25 11:42:02

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 4896 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 241 (class 1255 OID 16714)
-- Name: ajout_tiramisu(text, text, numeric, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_tiramisu(nom_t text, description_t text, prix_t numeric, photo_t text) RETURNS integer
    LANGUAGE plpgsql
    AS '
DECLARE
    id_retour INTEGER;
BEGIN
    SELECT id_tiramisu INTO id_retour FROM tiramisus WHERE nom_tiramisu = nom_t;

    IF FOUND THEN
        RETURN id_retour;
    ELSE
        INSERT INTO tiramisus(nom_tiramisu, description, prix, photo)
        VALUES (nom_t, description_t, prix_t::money, photo_t)
        RETURNING id_tiramisu INTO id_retour;

        RETURN id_retour;
    END IF;
END;
';


--
-- TOC entry 227 (class 1255 OID 16748)
-- Name: ajout_utilisateur(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.ajout_utilisateur(nom_user text, mdp_user text) RETURNS text
    LANGUAGE plpgsql
    AS '
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
';


--
-- TOC entry 226 (class 1255 OID 16713)
-- Name: get_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_admin(login text, password text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    nom_utilisateur TEXT;
BEGIN
    SELECT nom INTO nom_utilisateur
    FROM administrateurs
    WHERE nom = login AND mdp = password;

    IF FOUND THEN
        RETURN nom_utilisateur;
    ELSE
        RETURN ''ERREUR DE CONNEXION'';
    END IF;
END;
';


--
-- TOC entry 228 (class 1255 OID 16749)
-- Name: get_utilisateur(character varying, character varying); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.get_utilisateur(p_nom character varying, p_mdp character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS '
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
';


--
-- TOC entry 242 (class 1255 OID 16746)
-- Name: supprimer_tiramisu(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.supprimer_tiramisu(nom_t text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    nom_existant TEXT;
BEGIN
    SELECT nom_tiramisu INTO nom_existant FROM tiramisus WHERE nom_tiramisu = nom_t;

    IF nom_existant IS NULL THEN
        RETURN ''Aucun tiramisu trouvé'';
    ELSE
        DELETE FROM tiramisus WHERE nom_tiramisu = nom_t;
        RETURN ''Tiramisu supprimé'';
    END IF;
END;
';


--
-- TOC entry 229 (class 1255 OID 16747)
-- Name: supprimer_utilisateur(text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.supprimer_utilisateur(text) RETURNS text
    LANGUAGE plpgsql
    AS '
DECLARE
    nom_utilisateur ALIAS FOR $1;
    utilisateur_existant TEXT;
BEGIN
    SELECT nom INTO utilisateur_existant FROM utilisateurs WHERE nom = nom_utilisateur;

    IF utilisateur_existant IS NULL THEN
        RETURN ''Aucun utilisateur trouvé'';
    ELSE
        DELETE FROM utilisateurs WHERE nom = nom_utilisateur;
        RETURN ''Utilisateur supprimé'';
    END IF;
END;
';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 225 (class 1259 OID 16736)
-- Name: administrateurs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.administrateurs (
    id_admin integer NOT NULL,
    nom character varying(100) NOT NULL,
    mdp text NOT NULL
);


--
-- TOC entry 224 (class 1259 OID 16735)
-- Name: administrateurs_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.administrateurs_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4897 (class 0 OID 0)
-- Dependencies: 224
-- Name: administrateurs_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.administrateurs_id_admin_seq OWNED BY public.administrateurs.id_admin;


--
-- TOC entry 222 (class 1259 OID 16642)
-- Name: commandes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.commandes (
    id_commande integer NOT NULL,
    date_commande timestamp without time zone NOT NULL,
    id_utilisateur integer NOT NULL
);


--
-- TOC entry 221 (class 1259 OID 16641)
-- Name: commandes_id_commande_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.commandes_id_commande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4898 (class 0 OID 0)
-- Dependencies: 221
-- Name: commandes_id_commande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.commandes_id_commande_seq OWNED BY public.commandes.id_commande;


--
-- TOC entry 223 (class 1259 OID 16661)
-- Name: details_commande; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.details_commande (
    quantite integer NOT NULL,
    prix_total money NOT NULL,
    id_tiramisu integer NOT NULL,
    id_commande integer NOT NULL
);


--
-- TOC entry 220 (class 1259 OID 16625)
-- Name: tiramisus; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tiramisus (
    id_tiramisu integer NOT NULL,
    nom_tiramisu character varying(100) NOT NULL,
    description text NOT NULL,
    prix numeric(10,2) NOT NULL,
    photo text
);


--
-- TOC entry 219 (class 1259 OID 16624)
-- Name: tiramisus_id_tiramisu_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tiramisus_id_tiramisu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4899 (class 0 OID 0)
-- Dependencies: 219
-- Name: tiramisus_id_tiramisu_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tiramisus_id_tiramisu_seq OWNED BY public.tiramisus.id_tiramisu;


--
-- TOC entry 218 (class 1259 OID 16616)
-- Name: utilisateurs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.utilisateurs (
    id_utilisateur integer NOT NULL,
    nom character varying(100) NOT NULL,
    mdp character varying(150) NOT NULL
);


--
-- TOC entry 217 (class 1259 OID 16615)
-- Name: utilsateurs_id_utilisateur_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.utilsateurs_id_utilisateur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 4900 (class 0 OID 0)
-- Dependencies: 217
-- Name: utilsateurs_id_utilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.utilsateurs_id_utilisateur_seq OWNED BY public.utilisateurs.id_utilisateur;


--
-- TOC entry 4723 (class 2604 OID 16739)
-- Name: administrateurs id_admin; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.administrateurs ALTER COLUMN id_admin SET DEFAULT nextval('public.administrateurs_id_admin_seq'::regclass);


--
-- TOC entry 4722 (class 2604 OID 16645)
-- Name: commandes id_commande; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commandes ALTER COLUMN id_commande SET DEFAULT nextval('public.commandes_id_commande_seq'::regclass);


--
-- TOC entry 4721 (class 2604 OID 16628)
-- Name: tiramisus id_tiramisu; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tiramisus ALTER COLUMN id_tiramisu SET DEFAULT nextval('public.tiramisus_id_tiramisu_seq'::regclass);


--
-- TOC entry 4720 (class 2604 OID 16619)
-- Name: utilisateurs id_utilisateur; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.utilisateurs ALTER COLUMN id_utilisateur SET DEFAULT nextval('public.utilsateurs_id_utilisateur_seq'::regclass);


--
-- TOC entry 4890 (class 0 OID 16736)
-- Dependencies: 225
-- Data for Name: administrateurs; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.administrateurs (id_admin, nom, mdp) VALUES (1, 'Admin', 'Admin');
INSERT INTO public.administrateurs (id_admin, nom, mdp) VALUES (2, 'Jeremy', 'Jeremy');


--
-- TOC entry 4887 (class 0 OID 16642)
-- Dependencies: 222
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (1, '2024-01-25 00:00:00', 13);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (2, '2024-02-24 00:00:00', 13);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (3, '2024-01-09 00:00:00', 1);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (4, '2024-01-06 00:00:00', 2);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (5, '2024-02-02 00:00:00', 4);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (6, '2024-01-03 00:00:00', 13);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (7, '2024-01-19 00:00:00', 13);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (8, '2024-03-03 00:00:00', 1);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (9, '2024-02-07 00:00:00', 2);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (10, '2024-02-07 00:00:00', 1);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (11, '2024-02-18 00:00:00', 4);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (12, '2024-01-28 00:00:00', 13);
INSERT INTO public.commandes (id_commande, date_commande, id_utilisateur) VALUES (13, '2024-03-31 00:00:00', 3);


--
-- TOC entry 4888 (class 0 OID 16661)
-- Dependencies: 223
-- Data for Name: details_commande; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.details_commande (quantite, prix_total, id_tiramisu, id_commande) VALUES (2, '9,00 €', 1, 1);
INSERT INTO public.details_commande (quantite, prix_total, id_tiramisu, id_commande) VALUES (1, '6,50 €', 3, 1);
INSERT INTO public.details_commande (quantite, prix_total, id_tiramisu, id_commande) VALUES (3, '20,70 €', 4, 2);
INSERT INTO public.details_commande (quantite, prix_total, id_tiramisu, id_commande) VALUES (1, '4,00 €', 2, 3);
INSERT INTO public.details_commande (quantite, prix_total, id_tiramisu, id_commande) VALUES (2, '9,00 €', 1, 3);


--
-- TOC entry 4885 (class 0 OID 16625)
-- Dependencies: 220
-- Data for Name: tiramisus; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.tiramisus (id_tiramisu, nom_tiramisu, description, prix, photo) VALUES (3, 'Tiramisu Oreo', 'Un délicieux tiramisu revisité avec des morceaux d’Oreo, une crème vanillée et une base moelleuse au cacao!', 6.50, 'tiramisu-oreo.jpg');
INSERT INTO public.tiramisus (id_tiramisu, nom_tiramisu, description, prix, photo) VALUES (4, 'Tiramisu crêpes speculoos', 'Si tu aimes les tiramisus et les crêpes, ce tiramisu va être parfait pour toi! Accompagné d''un délicieux speculoos', 6.90, 'tiramisu-crepe-speculoos.jpg');
INSERT INTO public.tiramisus (id_tiramisu, nom_tiramisu, description, prix, photo) VALUES (1, 'Tiramisu Spéculoos', 'Un bon tiramisu masterclass aux spéculoos, avec une crème mascarpone!', 4.50, 'tiramisu-speculoos.jpeg');
INSERT INTO public.tiramisus (id_tiramisu, nom_tiramisu, description, prix, photo) VALUES (2, 'Tiramisu Biscuit au Beurre', 'Une version douce et gourmande du tiramisu, avec des biscuits sablés au beurre!', 4.00, 'tiramisu-biscuit-beurre.jpg');


--
-- TOC entry 4883 (class 0 OID 16616)
-- Dependencies: 218
-- Data for Name: utilisateurs; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.utilisateurs (id_utilisateur, nom, mdp) VALUES (1, 'Jeremy', 'Jeremy');
INSERT INTO public.utilisateurs (id_utilisateur, nom, mdp) VALUES (2, 'Mathieu', 'Mathieu');
INSERT INTO public.utilisateurs (id_utilisateur, nom, mdp) VALUES (3, 'Samed', 'Samed');
INSERT INTO public.utilisateurs (id_utilisateur, nom, mdp) VALUES (4, 'Auterlot', 'Auterlot');
INSERT INTO public.utilisateurs (id_utilisateur, nom, mdp) VALUES (13, 'jeremy', 'ok');


--
-- TOC entry 4901 (class 0 OID 0)
-- Dependencies: 224
-- Name: administrateurs_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.administrateurs_id_admin_seq', 2, true);


--
-- TOC entry 4902 (class 0 OID 0)
-- Dependencies: 221
-- Name: commandes_id_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.commandes_id_commande_seq', 1, false);


--
-- TOC entry 4903 (class 0 OID 0)
-- Dependencies: 219
-- Name: tiramisus_id_tiramisu_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tiramisus_id_tiramisu_seq', 17, true);


--
-- TOC entry 4904 (class 0 OID 0)
-- Dependencies: 217
-- Name: utilsateurs_id_utilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.utilsateurs_id_utilisateur_seq', 13, true);


--
-- TOC entry 4733 (class 2606 OID 16743)
-- Name: administrateurs administrateurs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.administrateurs
    ADD CONSTRAINT administrateurs_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4729 (class 2606 OID 16647)
-- Name: commandes commandes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_pkey PRIMARY KEY (id_commande);


--
-- TOC entry 4731 (class 2606 OID 16753)
-- Name: details_commande pk_details_commande; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT pk_details_commande PRIMARY KEY (id_commande, id_tiramisu);


--
-- TOC entry 4727 (class 2606 OID 16632)
-- Name: tiramisus tiramisus_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tiramisus
    ADD CONSTRAINT tiramisus_pkey PRIMARY KEY (id_tiramisu);


--
-- TOC entry 4725 (class 2606 OID 16621)
-- Name: utilisateurs utilsateurs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.utilisateurs
    ADD CONSTRAINT utilsateurs_pkey PRIMARY KEY (id_utilisateur);


--
-- TOC entry 4734 (class 2606 OID 16655)
-- Name: commandes commandes_id_utilisateur_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_id_utilisateur_fkey FOREIGN KEY (id_utilisateur) REFERENCES public.utilisateurs(id_utilisateur);


--
-- TOC entry 4735 (class 2606 OID 16672)
-- Name: details_commande details_commande_id_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT details_commande_id_commande_fkey FOREIGN KEY (id_commande) REFERENCES public.commandes(id_commande);


--
-- TOC entry 4736 (class 2606 OID 16667)
-- Name: details_commande details_commande_id_tiramisu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT details_commande_id_tiramisu_fkey FOREIGN KEY (id_tiramisu) REFERENCES public.tiramisus(id_tiramisu);


-- Completed on 2025-04-25 11:42:02

--
-- PostgreSQL database dump complete
--

