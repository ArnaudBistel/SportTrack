DROP TABLE Donnees;
DROP TABLE Activite;
DROP TABLE Utilisateur;

CREATE TABLE Utilisateur (
                        id integer CONSTRAINT pkId PRIMARY KEY ,
                        nom text CONSTRAINT nnNom NOT NULL,
                        prenom text CONSTRAINT nnPrenom NOT NULL,
                        dateNaissance DATE CONSTRAINT nnDate NOT NULL,
                        sexe text CONSTRAINT nnSexe NOT NULL,
                        taille integer 
                        CONSTRAINT nnTaille NOT NULL 
                        CONSTRAINT ckTaille CHECK(taille > 0 & taille < 250),
                        poids integer 
                        CONSTRAINT nnPoids NOT NULL 
                        CONSTRAINT nnPoids CHECK (poids > 0 & poids < 599),
                        mail text 
                        CONSTRAINT nnMail NOT NULL 
                        CONSTRAINT uqMail UNIQUE
                        CONSTRAINT ckMail CHECK( mail like '%_@__%.__%'),
                        motDePasse text CONSTRAINT nnMotDePasse NOT NULL
                      );

CREATE TABLE Activite (
                      noActivite integer CONSTRAINT pkNoActivite PRIMARY KEY,
                      dateActivite Date CONSTRAINT nnDateActivite NOT NULL,
                      description text CONSTRAINT nnDescription NOT NULL,
                      heureDebut DATETIME,
                      duree integer,
                      distance integer CONSTRAINT ckDistance CHECK (distance > 0),
                      freqCardiaqueMin integer 
                      CONSTRAINT ckFreqCardiaqueMin CHECK (freqCardiaqueMin > 0 & freqCardiaqueMin < 300),
                      freqCardiaqueMax integer 
                      CONSTRAINT ckFreqCardiaqueMax CHECK (freqCardiaqueMax > 0 & freqCardiaqueMax < 300),
                      freqCardiaqueMoy integer 
                      CONSTRAINT ckFreqCardiaqueMoy 
                      CHECK (freqCardiaqueMoy >= freqCardiaqueMin  & freqCardiaqueMoy <= freqCardiaqueMax),
                      lUtilisateur integer,
                      CONSTRAINT fkLUtilisateur FOREIGN KEY (lUtilisateur) REFERENCES Utilisateur(id)
                    );

CREATE TABLE Donnees (
                    lActivite integer,
                    temps TIME,
                    freqCardiaque integer NOT NULL 
                    CONSTRAINT ckFreqCardiaque CHECK(freqCardiaque > 0 & freqCardiaque < 300),
                    latitude FLOAT 
                    CONSTRAINT nnLatitude NOT NULL
                    CONSTRAINT ckLatitude CHECK (latitude <= 90.0 & latitude >= -90.0),
                    longitude FLOAT 
                    CONSTRAINT nnLongitude NOT NULL
                    CONSTRAINT ckLongitude CHECK (longitude <= 180 & longitude >= -180),
                    altitude FLOAT 
                    CONSTRAINT nnAltitude NOT NULL
                    CONSTRAINT ckAltitude CHECK (altitude >= -100 & altitude <= 9000),
                    CONSTRAINT fkLActivite FOREIGN KEY (lActivite) REFERENCES Activite (noActivite)
                    CONSTRAINT pkDonnees PRIMARY KEY (lActivite, temps)
			           		);
