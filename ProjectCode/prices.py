import json
from datetime import datetime, timedelta
import random

#Ta products pou exw epileksei apo ta all_products
products = [
    {
      "id": "699",
      "name": "Pedigree Denta Stix Small Σκύλου 110γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "0c6e42d52765495dbbd06c189a4fc80f"
    },
    {
      "id": "896",
      "name": "Pedigree Denta Stix Med Σκύλου 180γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "0c6e42d52765495dbbd06c189a4fc80f"
    },
    {
      "id": "1085",
      "name": "Friskies Σκυλ/Φή Ξηρ Κοτ/Λαχ 1,5κιλ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "0c6e42d52765495dbbd06c189a4fc80f"
    },
    {
      "id": "1132",
      "name": "Pedigree Σκυλ/Φή Μοσχάρι 400γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "0c6e42d52765495dbbd06c189a4fc80f"
    },
    {
      "id": "1154",
      "name": "Pedigree Schmackos Μπισκότα Σκύλου 43γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "0c6e42d52765495dbbd06c189a4fc80f"
    },
    {
      "id": "774",
      "name": "Purina One Γατ/Φή Ξηρά Βοδ/Σιτ 800γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "926262c303fe402a8542a5d5cf3ac7eb"
    },
    {
      "id": "897",
      "name": "Purina Gold Gourmet Γατ/Φή Μους Ψάρι 85γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "926262c303fe402a8542a5d5cf3ac7eb"
    },
    {
      "id": "930",
      "name": "Friskies Γατ/Φή Πατέ Κοτ/Λαχ 400γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "926262c303fe402a8542a5d5cf3ac7eb"
    },
    {
      "id": "1018",
      "name": "Friskies Γατ/Φή Πατέ Μοσχάρι 400γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "926262c303fe402a8542a5d5cf3ac7eb"
    },
    {
      "id": "1110",
      "name": "Whiskas Γατ/Φή Πουλ Σε Σάλτσα 100γρ",
      "category": "662418cbd02e435280148dbb8892782a",
      "subcategory": "926262c303fe402a8542a5d5cf3ac7eb"
    },
    {
      "id": "978",
      "name": "Μήλα Φουτζι Εγχ ",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "ea47cc6b2f6743169188da125e1f3761"
    },
    {
      "id": "980",
      "name": "Πορτοκ Μερλίν - Λανε Λειτ- Ναβελ Λειτ Εγχ Χυμ Συσκ/Να",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "ea47cc6b2f6743169188da125e1f3761"
    },
    {
      "id": "1142",
      "name": "Μήλα Στάρκιν Χύμα",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "ea47cc6b2f6743169188da125e1f3761"
    },
    {
      "id": "1201",
      "name": "Καρπούζια Μίνι Εγχ",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "ea47cc6b2f6743169188da125e1f3761"
    },
    {
      "id": "1336",
      "name": "Πορτοκ Μερλίν - Λανε Λειτ- Ναβελ Λειτ Κατ Α Εγχ Ε/Ζ",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "ea47cc6b2f6743169188da125e1f3761"
    },
    {
      "id": "1060",
      "name": "Ντομάτες Εισ Α",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "9bc82778d6b44152b303698e8f72c429"
    },
    {
      "id": "1112",
      "name": "Κολοκυθάκια Εγχ Με Ανθό",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "9bc82778d6b44152b303698e8f72c429"
    },
    {
      "id": "1224",
      "name": "Κρεμμύδια Ξανθά Ξερά Εισ",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "9bc82778d6b44152b303698e8f72c429"
    },
    {
      "id": "1236",
      "name": "Ντομάτες Εγχ Υπαιθρ Β ",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "9bc82778d6b44152b303698e8f72c429"
    },
    {
      "id": "1260",
      "name": "Μπρόκολα Πράσινα Εγχ",
      "category": "ee0022e7b1b34eb2b834ea334cda52e7",
      "subcategory": "9bc82778d6b44152b303698e8f72c429"
    },
    {
      "id": "379",
      "name": "Aim Οδ/Μα Παιδ 2/6ετων 50ml",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "26e416b6efa745218f810c34678734b2"
    },
    {
      "id": "414",
      "name": "Aim Οδ/μα White System 75ml",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "26e416b6efa745218f810c34678734b2"
    },
    {
      "id": "516",
      "name": "Sensodyne Οδ/μα Complete Protection 75ml",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "26e416b6efa745218f810c34678734b2"
    },
    {
      "id": "1064",
      "name": "Sensodyne Οδ/μα Repair/Protect 75ml",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "26e416b6efa745218f810c34678734b2"
    },
    {
      "id": "1143",
      "name": "Oral B Οδοντικό Νήμα Κηρωμένο 50τεμ",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "26e416b6efa745218f810c34678734b2"
    },
    {
      "id": "1011",
      "name": "Everyday Σερβ/Κια Norm All Cotton 24τεμ",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "2bce84e7df694ab1b81486aa2baf555d"
    },
    {
      "id": "1022",
      "name": "Everyday Σερβ Norm/Ultra Plus Hyp 18τεμ",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "2bce84e7df694ab1b81486aa2baf555d"
    },
    {
      "id": "1175",
      "name": "Everyday Σερβ Super/Ultra Plus Sens 18τεμ",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "2bce84e7df694ab1b81486aa2baf555d"
    },
    {
      "id": "1301",
      "name": "Always Σερβ Night 9τεμ",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "2bce84e7df694ab1b81486aa2baf555d"
    },
    {
      "id": "1348",
      "name": "Everyday Σερβ Norm/Ultra Plus Sens 18τεμ",
      "category": "8e8117f7d9d64cf1a931a351eb15bd69",
      "subcategory": "2bce84e7df694ab1b81486aa2baf555d"
    },
    {
      "id": "1077",
      "name": "Coca Cola 250ml",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "3010aca5cbdc401e8dfe1d39320a8d1a"
    },
    {
      "id": "1152",
      "name": "Coca Cola 2Χ1,5λιτ",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "3010aca5cbdc401e8dfe1d39320a8d1a"
    },
    {
      "id": "1153",
      "name": "Sprite 6X330ml",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "3010aca5cbdc401e8dfe1d39320a8d1a"
    },
    {
      "id": "1322",
      "name": "Fanta Πορτοκαλάδα 1,5λιτ",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "3010aca5cbdc401e8dfe1d39320a8d1a"
    },
    {
      "id": "1332",
      "name": "Tuborg Σόδα 330ml",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "3010aca5cbdc401e8dfe1d39320a8d1a"
    },
    {
      "id": "1178",
      "name": "Όλυμπος Φυσικός Χυμός Πορτοκάλι 1,5λιτ",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "4f1993ca5bd244329abf1d59746315b8"
    },
    {
      "id": "1203",
      "name": "Frulite Φρουτοπoτό Πορτ/Βερικ 500ml",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "4f1993ca5bd244329abf1d59746315b8"
    },
    {
      "id": "1266",
      "name": "Cool Hellas Χυμός Πορτοκαλ Συμπ 1λιτ",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "4f1993ca5bd244329abf1d59746315b8"
    },
    {
      "id": "1305",
      "name": "Frulite Σαγκουίνι/Μανταρίνι 1λιτ",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "4f1993ca5bd244329abf1d59746315b8"
    },
    {
      "id": "1337",
      "name": "Όλυμπος Φυσικός Χυμός Πορτοκάλι 1λιτ",
      "category": "a8ac6be68b53443bbd93b229e2f9cd34",
      "subcategory": "4f1993ca5bd244329abf1d59746315b8"
    }
]
# Orise to date range
start_date = datetime(2023, 1, 1)
end_date = datetime(2023, 9, 21)
date_range = [start_date + timedelta(days=i) for i in range((end_date - start_date).days + 1)]
num_dates_to_generate = 5 #dld na dinei 5 dates gia kathe proion
selected_dates = random.sample(date_range, num_dates_to_generate)
# Generate JSON data with prices
all_prices = []

for product in products:
    for date in selected_dates:
        price = round(random.uniform(0.25, 4.5), 2)  #dwse random price pou kumainontai apo 1 - 4.5 euros
        all_prices.append({
            "id": product["id"],
            "name": product["name"],
            "category": product["category"],
            "date": date.strftime("%Y-%m-%d"),
            "price": price
        })

# Convert the result to JSON 
json_prices = json.dumps(all_prices, indent=4, ensure_ascii=False)
print(json_prices)
