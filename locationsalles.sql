-- =========================
-- BASE DE DONNÉES : LOCATION DE SALLES
-- =========================

-- =========================
-- TABLE : utilisateurs
-- =========================
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    fonction VARCHAR(50) NOT NULL,
    mot_de_passe_hash VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLE : salles
-- =========================
CREATE TABLE salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    capacite INT NOT NULL,
    Descriptif TEXT,
    disponible BOOLEAN DEFAULT TRUE
);

-- =========================
-- TABLE : reservations
-- =========================
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    salle_id INT NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    statut VARCHAR(50) DEFAULT 'en attente',

    CONSTRAINT fk_reservation_utilisateur
        FOREIGN KEY (utilisateur_id)
        REFERENCES utilisateurs(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_reservation_salle
        FOREIGN KEY (salle_id)
        REFERENCES salles(id)
        ON DELETE CASCADE,

    CONSTRAINT chk_dates
        CHECK (date_fin > date_debut)
);

-- =========================
-- TABLE : factures
-- =========================
CREATE TABLE factures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT NOT NULL,
    montant_total DECIMAL(10,2) NOT NULL,
    statut VARCHAR(50) DEFAULT 'non payée',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_facture_reservation
        FOREIGN KEY (reservation_id)
        REFERENCES reservations(id)
        ON DELETE CASCADE
);

-- =========================
-- TABLE : paiements
-- =========================
CREATE TABLE paiements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facture_id INT NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    methode_paiement VARCHAR (50),
    date_paiement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_paiement_facture
        FOREIGN KEY (facture_id)
        REFERENCES factures(id)
        ON DELETE CASCADE
);

-- =========================
-- TABLE : messages
-- =========================
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expediteur_id INT NOT NULL,
    destinataire_id INT NOT NULL,
    contenu TEXT NOT NULL,
    statut VARCHAR(20) DEFAULT 'non lu',
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_message_expediteur
        FOREIGN KEY (expediteur_id)
        REFERENCES utilisateurs(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_message_destinataire
        FOREIGN KEY (destinataire_id)
        REFERENCES utilisateurs(id)
        ON DELETE CASCADE
);

-- =========================
-- TRIGGER : empêcher les réservations qui se chevauchent
-- =========================
DELIMITER $$

CREATE TRIGGER check_reservation_overlap
BEFORE INSERT ON reservations
FOR EACH ROW
BEGIN
    IF EXISTS (
        SELECT 1
        FROM reservations
        WHERE salle_id = NEW.salle_id
          AND NEW.date_debut < date_fin
          AND NEW.date_fin > date_debut
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Conflit : cette salle est déjà réservée sur cette période';
    END IF;
END$$

DELIMITER ;
