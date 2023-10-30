/1/ le nombre total de consultations --> 26
SELECT count(specialiteID)
 FROM consultation;

/2/ le nombre total de patients --> 27
SELECT count(patientID)
 FROM patient;

 /3/ le nombre total des patients 'femme' --> 18
 SELECT count(patientID)
 FROM patient
 WHERE sexe = 'femme';

 /4/ un tableau avec le nombre de patients femme et homme /-->18 et -->9/
 SELECT sexe, COUNT(*) as nombre 
 FROM patient 
 WHERE sexe IN ('femme', 'homme') 
 GROUP BY sexe;
 
 /5/ les specialites et le nombre de demandes de chacun d'elles
 SELECT nom_specialiste, COUNT(*) AS nombreDemandes
 FROM consultation
 JOIN specialite ON consultation.specialiteID = specialite.specialiteID
 GROUP BY nom_specialiste;





 
