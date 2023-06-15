from tkinter import *
from tkinter import filedialog
from PIL import Image, ImageTk
from DatabaseUtility import *

def edit_image():
    file_path = filedialog.askopenfilename()

    if file_path:
        image = Image.open(file_path)

        image_left = image.copy().resize((200, 200))
        image_left = ImageTk.PhotoImage(image_left)
        label_left.configure(image=image_left)
        label_left.image = image_left

        image_original = image_copy = image_right = image.copy()
        image_right = ImageTk.PhotoImage(image_right)
        label_right.configure(image=image_right)
        label_right.image = image_right

        label_right.bind("<Button-1>", lambda event: get_pixel(event, file_path))

        database = DatabaseUtility()
        listaColores = database.GetAll()

        for color in listaColores:

            print("Cargando datos...", color)
            cR = int(color["cR"])
            cG = int(color["cG"])
            cB = int(color["cB"])
            colorcambio = color["color"]

            clR = int(colorcambio[0:2], 16)
            clG = int(colorcambio[2:4], 16)
            clB = int(colorcambio[4:6], 16)

            for i in range(0, image_copy.width - 10, 10):
                for j in range(0, image_copy.height - 10, 10):
                    mmR, mmG, mmB = 0, 0, 0
                    for k in range(i, i + 10):
                        for l in range(j, j + 10):
                            c = image_copy.getpixel((k, l))
                            mmR += c[0]
                            mmG += c[1]
                            mmB += c[2]
                    mmR //= 100
                    mmG //= 100
                    mmB //= 100

                    if (((cR - 10 < mmR) and (mmR < cR + 10)) and
                        ((cG - 10 < mmG) and (mmG < cG + 10)) and
                        ((cB - 10 < mmB) and (mmB < cB + 10))):

                        for k in range(i, i + 10):
                            for l in range(j, j + 10):
                                image_copy.putpixel((k, l), (clR, clG, clB))
                    else:
                        for k in range(i, i + 10):
                            for l in range(j, j + 10):
                                c = image_original.getpixel((k, l))
                                image_copy.putpixel((k, l), c)

        image_right = ImageTk.PhotoImage(image_copy)
        label_right.configure(image=image_right)
        label_right.image = image_right      

def save_results():
    description = entry_description.get()
    color_name = entry_color_name.get()
    print("Descripción del color:", description)
    print("Nombre del color:", color_name)

def get_pixel(event, image_path):
    x = event.x
    y = event.y
    print("(x, y):", x, y, image_path)

    image = Image.open(image_path)
    image_copy = image.copy()

    c = (0, 0, 0)
    mR, mG, mB = 0, 0, 0

    for i in range(event.x - 5, event.x + 5):
        for j in range(event.y - 5, event.y + 5):
            c = image_copy.getpixel((i, j))
            mR += c[0]
            mG += c[1]
            mB += c[2]
    mR //= 100
    mG //= 100
    mB //= 100

    description = entry_description.get()
    color_name = entry_color_name.get()

    print("Descripcion del color:", description)
    print("Nombre del color:", color_name)
    print(mR, mG, mB)

    database = DatabaseUtility()
    database.Insert(description, mR, mG, mB, color_name)

    image_right = ImageTk.PhotoImage(image_copy)
    label_right.configure(image=image_right)
    label_right.image = image_right

root = Tk()
root.title("Basic GUI Layout")
root.maxsize(1024, 900)
root.config(bg="skyblue")

left_frame = Frame(root, width=200, height=800, bg='blue')
left_frame.grid(row=0, column=0, padx=10, pady=5, sticky="n")

right_frame = Frame(root, width=650, height=800, bg='grey')
right_frame.grid(row=0, column=1, padx=10, pady=5, sticky="nsew")
root.columnconfigure(1, weight=1)

label_left = Label(left_frame, bg='white')
label_left.grid(row=1, column=0, padx=5, pady=5)

label_right = Label(right_frame, bg='white')
label_right.grid(row=0, column=0, padx=5, pady=5)

Label(left_frame, text="Original Image").grid(row=0, column=0, padx=5, pady=5)

edit_button = Button(left_frame, text="Cargar Imagen", command=edit_image)
edit_button.grid(row=2, column=0, padx=5, pady=3, ipadx=10)

tool_bar = Frame(left_frame, width=180, height=600)
tool_bar.grid(row=3, column=0, padx=5, pady=5, sticky="nsew")
tool_bar.columnconfigure(0, weight=1)

label_description = Label(tool_bar, text="Descripción del color:")
label_description.grid(row=2, column=0, padx=5, pady=5, sticky="w")

entry_description = Entry(tool_bar)
entry_description.grid(row=3, column=0, padx=5, pady=5)

label_color_name = Label(tool_bar, text="Nombre del color:")
label_color_name.grid(row=4, column=0, padx=5, pady=5, sticky="w")

entry_color_name = Entry(tool_bar)
entry_color_name.grid(row=5, column=0, padx=5, pady=5)

database = DatabaseUtility()
listaColores = database.GetAll()

row_counter = 6
for color in listaColores:
    nombre = color["descripcion"]
    codigo = "#" + color["color"]

    label_nombre = Label(tool_bar, text=nombre)
    label_nombre.grid(row=row_counter, column=0, padx=5, pady=5)

    label_color = Label(tool_bar, bg=codigo, width=10, height=2)
    label_color.grid(row=row_counter, column=1, padx=5, pady=5)

    row_counter += 1

save_button = Button(tool_bar, text="Guardar", command=save_results)
save_button.grid(row=row_counter + 1, column=0, padx=10, pady=3, ipadx=10)

root.mainloop()
