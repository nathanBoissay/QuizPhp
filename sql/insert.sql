
INSERT INTO USER (NOM, PRENOM, EMAIL, TELEPHONE, PASSWORD, ROLE, SEXE) VALUES ('Alice', 'Rojo', 'Alice@gmail.com', '0666666666', '789', 'ADMIN', 'F');
INSERT INTO USER (NOM, PRENOM, EMAIL, TELEPHONE, PASSWORD, ROLE, SEXE) VALUES ('Korentin', 'Goerget', 'korentin@gmail.com', '0666666666', '456', 'USER', 'H');
INSERT INTO USER (NOM, PRENOM, EMAIL, TELEPHONE, PASSWORD, ROLE, SEXE) VALUES ('Nathan', 'Boissay', 'nathan@gmail.com', '0666666666', '123', 'USER', 'H');


INSERT INTO QUESTIONNAIRE(NOMQUESTIONNAIRE, THEMEQUESTIONNAIRE, NOMBREQUESTION) VALUES ('Quiz sur les jours de la semaine', 'CultureG', 5);

INSERT INTO QUESTION(NOMQUESTION, INTITULE, TYPEQUESTION, IDQUESTIONNAIRE) VALUES ('Question 1', 'Quel est le troisième jour de la semaine', 'Choix unique', 1);
INSERT INTO QUESTION(NOMQUESTION, INTITULE, TYPEQUESTION, IDQUESTIONNAIRE) VALUES ('Question 2', 'Quel est mon jour préféré ?', 'Choix unique', 1);
INSERT INTO QUESTION(NOMQUESTION, INTITULE, TYPEQUESTION, IDQUESTIONNAIRE) VALUES ('Question 3', 'Le jour le plus productif ?', 'Choix unique', 1);
INSERT INTO QUESTION(NOMQUESTION, INTITULE, TYPEQUESTION, IDQUESTIONNAIRE) VALUES ('Question 4', 'Jour de repos favoris ?','Choix unique',1);
INSERT INTO QUESTION(NOMQUESTION, INTITULE, TYPEQUESTION, IDQUESTIONNAIRE) VALUES ('Question 5','Le jour au milieu de la semaine ?', 'Choix unique', 1);


INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Mercredi', 'Mercredi', true, 1);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Jeudi', 'Jeudi', false, 1);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Vendredi', 'Vendredi', false, 1);

-- Réponses pour la question 2
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Mercredi', 'Mercredi', true, 2);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Jeudi', 'Jeudi', false, 2);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Vendredi', 'Vendredi', false, 2);

-- Réponses pour la question 3
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Lundi', 'Lundi', true, 3);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Samedi', 'Samedi', false, 3);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Vendredi', 'Vendredi', false, 3);
-- Réponses pour la question 4
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Dimanche', 'Dimanche', true, 4);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Jeudi', 'Jeudi', false, 4);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Vendredi', 'Vendredi', false, 4);

-- Réponses pour la question 5
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Mercredi', 'Mercredi', false, 5);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Jeudi', 'Jeudi', true, 5);
INSERT INTO REPONSE (NOMREPONSE, INTITULEREPONSE, BONNE, IDQUESTION) VALUES ('Vendredi', 'Vendredi', false, 5);





