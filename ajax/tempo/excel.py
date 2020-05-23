import xlsxwriter
import json
from datetime import date

today = date.today()

#tracking last row inserted
row = 0

# open json created by php from db
with open('tempo/productions.json') as json_file:
    fichier = json.load(json_file)

# Create a workbook and add a worksheet.
workbook = xlsxwriter.Workbook('tempo/productions.xlsx')
worksheet = workbook.add_worksheet('productions')
date_format = workbook.add_format({'num_format': 'yyyy-mm'})

#insert the headers
#image header
worksheet.insert_image(row, 0, 'tempo/header-usthb.png')
row += 6

#information about this bilan
worksheet.write(row, 0, 'Information sur le bilan')
row += 1

if(not(fichier['projet'] is None)):
    worksheet.add_table(row,0,row+1,3,{
        'name': 'infoBilan',
        'style': 'Table Style Medium 9',
        'autofilter': False,
        'columns': [
            {'header': 'Type'},
            {'header': 'Effectué le'},
            {'header': 'Période du'},
            {'header': 'Au'}
        ]
    })
    worksheet.write(row+1, 0, 'Bilan projet')
else:
    worksheet.add_table(row,0,row+1,5,{
        'name': 'infoBilan',
        'style': 'Table Style Medium 9',
        'autofilter': False,
        'columns': [
            {'header': 'Type'},
            {'header': 'Effectué le'},
            {'header': 'Période du'},
            {'header': 'Au'},
            {'header': 'Pour'},
            {'header': 'Nom'}
        ]
    })
    worksheet.write(row+1, 0, 'Bilan d\'activité')
    worksheet.write(row+1, 4, fichier['pour'])
    worksheet.write(row+1, 5, fichier['nom'])
worksheet.write(row+1, 1, today, date_format )
info = row+1
row += 3

if(not(fichier['projet'] is None)):
    worksheet.write(row, 0, 'Description du projet: ')
    row += 1

    worksheet.write(row, 0, fichier['projet']['description'])
    row += 2

    worksheet.write(row, 0, 'Information sur le projet: ')
    row += 1

    liste = fichier['projet']
    data = []

    columns = []
    for atr in liste:
        if(atr == 'description'):
            continue

        columns.append(
            {'header': atr}
        )
        if(liste[atr] is None):
            data.append('')
        else:
            data.append(liste[atr])

    worksheet.add_table(row,0,row+1,len(liste)-2,{
        'name': 'projet',
        'style': 'Table Style Medium 9',
        'autofilter': False,
        'columns': columns,
        'data': [data]
    })
    row += 3

style = 3
for production in fichier:
    if(fichier[production] is None):
        continue

    if(production == 'dateDeb'):
        worksheet.write(info, 2, fichier['dateDeb'], date_format )
        #print(production['dateDeb'])
        continue

    if(production == 'dateFin'):
        worksheet.write(info, 3, fichier['dateFin'], date_format )
        #print(production['dateFin'])
        continue

    if(production == 'projet'):
        continue

    if(production == 'pour'):
        continue

    if(production == 'nom'):
        continue

    worksheet.write(row, 0, 'Tableau: '+production)
    row += 1

    liste = fichier[production]
    data = []

    columns = []
    for atr in liste[0]:
        columns.append(
            {'header': atr}
        )
    
    for elm in liste:
        tempo = []
        for attr in elm:
            tempo.append(elm[attr])
        data.append(tempo)

    worksheet.add_table(row,0,row+len(liste),len(liste[0])-1,{
        'name': production,
        'style': 'Table Style Medium %tl'.replace('%tl',str(style)),
        'autofilter': False,
        'columns': columns,
        'data': data
    })
    style += 1
    row += len(liste)+2


#worksheet.center_horizontally()
#worksheet.center_vertically()
#header-usthb.png
#worksheet.insert_image('B2', 'header-usthb.png')
#worksheet.set_header('&LCiao&CBello&RCielo')
#worksheet.add_table()

workbook.close()