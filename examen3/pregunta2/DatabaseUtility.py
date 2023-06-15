import mysql.connector

class DatabaseUtility:
    def __init__(self):
        self.con = mysql.connector.connect(
            host='127.0.0.1',
            user='user',
            password='user',
            database='imagenes'
        )
        self.cursor = self.con.cursor()

    def Insert(self, descripcion, r, g, b, color):
        query = "INSERT INTO colores (descripcion, cR, cG, cB, color) VALUES (%s, %s, %s, %s, %s)"
        params = (descripcion, r, g, b, color)
        self.cursor.execute(query, params)
        self.con.commit()

    def GetAll(self):
        query = "SELECT * FROM colores"
        self.cursor.execute(query)
        rows = self.cursor.fetchall()

        results = []
        for row in rows:
            descripcion = row[1]
            cR = row[2]
            cG = row[3]
            cB = row[4]
            color = row[5]
            results.append({"descripcion": descripcion, "cR": cR, "cG": cG, "cB": cB, "color": color})

        return results
