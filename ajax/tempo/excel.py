import xlsxwriter
import json
from datetime import date

#init size for each column to track max width size of it
max_size_col = {}
for i in range(13):
    max_size_col[i] = 0

#functions to insert the right header
def insert_header_activite(worksheet, pour, nom, grade, equipes, chefequip, menbrequip, laboratoire, cheflabo, domaine, dateDeb, dateFin, row):
    if(pour == 'laboratoire'):
        worksheet.write(row,1,'Bilan d\'activité pour laboratoire', header)
        row += 1
        worksheet.write(row,1,nom)
        row += 1
        worksheet.write(row,1,'Domaine: -d-'.replace('-d-', domaine))
        row += 1
        worksheet.write(row,1,'Période: de -deb- à -fin-'.replace('-deb-', dateDeb).replace('-fin-', dateFin))
        row += 3
        worksheet.write(row, 0, 'Chef de laboratoire:')
        worksheet.write(row, 1, cheflabo)
        row += 1
        worksheet.write(row, 0, 'Les équipes:')
        worksheet.write(row, 1, equipes)
        row += 4
    elif(pour == 'equipe'):
        worksheet.write(row,1,'Bilan d\'activité pour équipe')
        row += 1
        worksheet.write(row,1,nom)
        row += 1
        worksheet.write(row,1,'Domaine: -d-'.replace('-d-', domaine))
        row += 1
        worksheet.write(row,1,'Période: de -deb- à -fin-'.replace('-deb-', dateDeb).replace('-fin-', dateFin))
        row += 3
        worksheet.write(row, 0, 'Laboratoire:')
        worksheet.write(row, 1, laboratoire)
        row += 1
        worksheet.write(row, 0, 'Chef d\'équipe:')
        worksheet.write(row, 1, chefequip)
        row += 1
        worksheet.write(row, 0, 'Membres:')
        worksheet.write(row, 1, menbrequip)
        row += 4
    else:
        worksheet.write(row,1,'Bilan individuel d\'activité')
        row += 2
        worksheet.write(row,1,'Domaine: -d-'.replace('-d-', domaine))
        row += 1
        worksheet.write(row,1,'Période: de -deb- à -fin-'.replace('-deb-', dateDeb).replace('-fin-', dateFin))
        row += 2
        worksheet.write(row, 1, nom)
        row += 1
        worksheet.write(row, 1, 'Grade du chercheur:')
        worksheet.write(row, 2, grade)
        row += 2
        worksheet.write(row, 0, 'Laboratoire:')
        worksheet.write(row, 1, laboratoire)
        row += 1
        worksheet.write(row, 0, 'Equipe:')
        worksheet.write(row, 1, equipes)
        row += 2
    return row

def insert_pub_inter(worksheet, publications, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les publications internationales', bold)
    row += 2
    columns = [
        'Titre', 'Auteurs', 'Année-Mois', 'Revue', 'E-ISSN', 'ISSN', 'Editeur', 'Volume', 'Issue', 'URL', 'DOI', 'Classe'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(len(publications) == 0):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    for publication in publications:
        col = 0
        for attr in publication:
            if(attr == 'type'):
                break
            elif(attr == 'auteurP'):
                worksheet.write(row, col, publication[attr]+', '+publication['auteurs'], table_border)
                if(publication[attr] and len(publication[attr]+', '+publication['auteurs']) > max_size_col[col]):
                    max_size_col[col] = len(publication[attr]+', '+publication['auteurs'])
                col += 1
            elif(attr == 'auteurs'):
                continue
            else:
                worksheet.write(row, col, publication[attr], table_border)
                if(publication[attr] and len(publication[attr]) > max_size_col[col]):
                    max_size_col[col] = len(publication[attr])
                col += 1
        row += 1
    row += 1
    return row

def insert_pub_nat(worksheet, publications, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les publications Nationales', bold)
    row += 2
    columns = [
        'Titre', 'Auteurs', 'Année-Mois', 'Revue-Pays', 'E-ISSN', 'ISSN', 'Editeur', 'Volume', 'Issue', 'URL', 'DOI', 'Classe'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(len(publications) == 0):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    for publication in publications:
        col = 0
        for attr in publication:
            if(attr == 'revue'):
                worksheet.write(row, col, publication[attr]+' - '+publication['pays'], table_border)
                if(publication[attr] and len(publication[attr]+' - '+publication['pays']) > max_size_col[col]):
                    max_size_col[col] = len(publication[attr]+' - '+publication['pays'])
                col += 1
            elif(attr == 'type'):
                break
            elif(attr == 'auteurP'):
                worksheet.write(row, col, publication[attr]+', '+publication['auteurs'], table_border)
                if(publication[attr] and len(publication[attr]+', '+publication['auteurs']) > max_size_col[col]):
                    max_size_col[col] = len(publication[attr]+', '+publication['auteurs'])
                col += 1
            elif(attr == 'auteurs'):
                continue
            else:
                worksheet.write(row, col, publication[attr], table_border)
                if(publication[attr] and len(publication[attr]) > max_size_col[col]):
                    max_size_col[col] = len(publication[attr])
                col += 1
        row += 1
    row += 1
    return row

def insert_com_inter(worksheet, communications, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les communications Internationales', bold)
    row += 2
    columns = [
        'Titre', 'Auteurs', 'Année-Mois', 'Nom conférence', 'Lieu', 'URL', 'Classe'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(len(communications) == 0):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    for communication in communications:
        col = 0
        for attr in communication:
            if(attr == 'type'):
                break
            elif(attr == 'auteurP'):
                worksheet.write(row, col, communication[attr]+', '+communication['auteurs'], table_border)
                if(communication[attr] and len(communication[attr]+', '+communication['auteurs']) > max_size_col[col]):
                    max_size_col[col] = len(communication[attr]+', '+communication['auteurs'])
                col += 1
            elif(attr == 'auteurs'):
                continue
            else:
                worksheet.write(row, col, communication[attr], table_border)
                if(communication[attr] and len(communication[attr]) > max_size_col[col]):
                    max_size_col[col] = len(communication[attr])
                col += 1
        row += 1
    row += 1
    return row

def insert_com_nat(worksheet, communications, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les communications Nationales', bold)
    row += 2
    columns = [
        'Titre', 'Auteurs', 'Année-Mois', 'Nom conférence', 'Pays', 'URL', 'Classe'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(len(communications) == 0):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    for communication in communications:
        col = 0
        for attr in communication:
            if(attr == 'type'):
                break
            elif(attr == 'auteurP'):
                worksheet.write(row, col, communication[attr]+', '+communication['auteurs'], table_border)
                if(communication[attr] and len(communication[attr]+', '+communication['auteurs']) > max_size_col[col]):
                    max_size_col[col] = len(communication[attr]+', '+communication['auteurs'])
                col += 1
            elif(attr == 'auteurs'):
                continue
            else:
                worksheet.write(row, col, communication[attr], table_border)
                if(communication[attr] and len(communication[attr]) > max_size_col[col]):
                    max_size_col[col] = len(communication[attr])
                col += 1
        row += 1
    row += 1
    return row

def insert_chapitre(worksheet, chapitres, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les chapitres d\'ouvrages', bold)
    row += 2
    columns = [
        'Titre', 'Auteurs', 'Année-Mois', 'ISBN', 'Editeur', 'URL'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(chapitres is None):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    else:
        for chapitre in chapitres:
            col = 0
            for attr in chapitre:
                if(attr == 'auteurP'):
                    worksheet.write(row, col, chapitre[attr]+', '+chapitre['auteurs'], table_border)
                    if(chapitre[attr] and len(chapitre[attr]+', '+chapitre['auteurs']) > max_size_col[col]):
                        max_size_col[col] = len(chapitre[attr]+', '+chapitre['auteurs'])
                    col += 1
                elif(attr == 'auteurs'):
                    continue
                else:
                    worksheet.write(row, col, chapitre[attr], table_border)
                    if(chapitre[attr] and len(chapitre[attr]) > max_size_col[col]):
                        max_size_col[col] = len(chapitre[attr])
                    col += 1
            row += 1
    row += 1
    return row

def insert_ouvrage(worksheet, ouvrages, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les Ouvrages', bold)
    row += 2
    columns = [
        'Titre', 'Auteurs', 'Année-Mois', 'ISBN', 'Editeur', 'URL'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(ouvrages is None):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    else:
        for ouvrage in ouvrages:
            col = 0
            for attr in ouvrage:
                if(attr == 'auteurP'):
                    worksheet.write(row, col, ouvrage[attr]+', '+ouvrage['auteurs'], table_border)
                    if(ouvrage[attr] and len(ouvrage[attr]+', '+ouvrage['auteurs']) > max_size_col[col]):
                        max_size_col[col] = len(ouvrage[attr]+', '+ouvrage['auteurs'])
                    col += 1
                elif(attr == 'auteurs'):
                    continue
                else:
                    worksheet.write(row, col, ouvrage[attr], table_border)
                    if(ouvrage[attr] and len(ouvrage[attr]) > max_size_col[col]):
                        max_size_col[col] = len(ouvrage[attr])
                    col += 1
            row += 1
    row += 1
    return row

def insert_doctorat(worksheet, doctorats, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les soutenances de Doctorat', bold)
    row += 2
    columns = [
        'Titre', 'Année-Mois', 'Directeur de thèse', 'Spécialité', 'Numéro', 'Lieu'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(doctorats is None):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    else:
        for doctorat in doctorats:
            col = 0
            for attr in doctorat:
                worksheet.write(row, col, doctorat[attr], table_border)
                if(doctorat[attr] and len(doctorat[attr]) > max_size_col[col]):
                    max_size_col[col] = len(doctorat[attr])
                col += 1
            row += 1
    row += 1
    return row

def insert_master(worksheet, masters, row):
    global max_size_col
    #insert table header
    worksheet.write(row, 0, 'Les soutenances de Master', bold)
    row += 2
    columns = [
        'Titre', 'Année-Mois', 'Promoteur', 'Spécialité', 'Lieu'  
    ]
    col = 0
    for column in columns:
        worksheet.write(row, col, column, table_header)
        if(len(column) > max_size_col[col]):
            max_size_col[col] = len(columns)
        col += 1
    row += 1
    if(masters is None):
        col = 0
        for column in columns:
            worksheet.write(row, col, '', table_border)
            col += 1
        row += 1
    else:
        for master in masters:
            col = 0
            for attr in master:
                worksheet.write(row, col, master[attr], table_border)
                if(master[attr] and len(master[attr]) > max_size_col[col]):
                    max_size_col[col] = len(master[attr])
                col += 1
            row += 1
    row += 1
    return row

#Today's date
today = date.today()

#tracking last row inserted
row = 0

# open json created by php from db
with open('tempo/productions.json') as json_file:
    fichier = json.load(json_file)

# Create a workbook and add a worksheet.
workbook = xlsxwriter.Workbook('tempo/productions.xlsx')
worksheet = workbook.add_worksheet('productions')

# Create formats
date_format = workbook.add_format({'num_format': 'yyyy-mm'})
bold = workbook.add_format({'bold': True})
header = workbook.add_format({'bold': True, 'font_size': 14})
table_header = workbook.add_format({'bg_color': 'green', 'border': True, 'border_color': 'black'})
table_border = workbook.add_format({'border': True, 'border_color': 'black'})

#insert the page header
#image header
worksheet.insert_image(row, 0, 'tempo/header-usthb.png')
row += 6

#information about this bilan
worksheet.write(row, 0, 'Date:-d-'.replace('-d-',str(today)), date_format)
row += 1

#insert header
if(fichier['projet'] is None):
    row = insert_header_activite(worksheet, fichier['pour'], fichier['nom'], fichier['grade'], fichier['equipes'], fichier['chefequip'], fichier['menbrequip'], fichier['laboratoire'], fichier['cheflabo'], fichier['domaine'], fichier['dateDeb'], fichier['dateFin'], row)

#inserer publications
publications = fichier['publication']
publications_inter = []
publications_nat = []
for publication in publications:
    if(publication['type'] == 'internationale'):
        publications_inter.append(publication)
    else:
        publications_nat.append(publication)
row = insert_pub_inter(worksheet, publications_inter, row)
row = insert_pub_nat(worksheet, publications_nat, row)

#inserer communications
communications = fichier['communication']
communications_inter = []
communications_nat = []
for communication in communications:
    if(communication['type'] == 'internationale'):
        communications_inter.append(communication)
    else:
        communications_nat.append(communication)
row = insert_com_inter(worksheet, communications_inter, row)
row = insert_com_nat(worksheet, communications_nat, row)

#inserer les chapitre d'ouvrages
row = insert_chapitre(worksheet, fichier['chapitreOuvrage'], row)

#inserer les ouvrages
row = insert_ouvrage(worksheet, fichier['ouvrage'], row)

#inserer les doctorats
row = insert_doctorat(worksheet, fichier['doctorat'], row)

#inserer les masters
row = insert_master(worksheet, fichier['master'], row)

#set width of columns = max
for i in max_size_col:
    print(i)
    worksheet.set_column(i, i, max_size_col[i])

workbook.close()