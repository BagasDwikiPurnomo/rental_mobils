import tkinter as tk
from tkinter import simpledialog, messagebox
import requests
import random
import string
from datetime import datetime

# URL webhook Discord default
default_webhook_url = 'https://discord.com/api/webhooks/1273562052434202686/bxRpOWQQlMIbFQzctyu8FOZcZkuAtDnFOOJ4oQmjHGh_kE40f0TOAstimO74Kyaozwuv'

def generate_session_id(length=5):
    # Generate a 5-digit session ID with a combination of uppercase letters and digits
    characters = string.ascii_uppercase + string.digits
    return ''.join(random.choices(characters, k=length))

def send_to_discord(session_url, webhook_url):
    # Generate a 5-digit session ID
    session_id = generate_session_id()
    # Get the current timestamp formatted as MM/DD/YYYY HH:MM AM/PM
    timestamp = datetime.now().strftime('%m/%d/%Y %I:%M %p')

    embed = {
        "title": "New Live Share Session",
        "description": f"**Session ID:**\n-> {session_id} <-\n\nRight click & Copy link the session URL below:\n{session_url}",
        "color": 3447003,  # Blue color
        "footer": {
            "text": f"{timestamp}",
        }
    }
    data = {"embeds": [embed]}

    try:
        response = requests.post(webhook_url, json=data)
        if response.status_code == 204:
            # Copy the session URL to the clipboard
            root = tk.Tk()
            root.withdraw()  # Hide the root window
            root.clipboard_clear()
            root.clipboard_append(session_url)
            root.update()  # Keep the clipboard updated
            root.destroy()

            messagebox.showinfo("Success", "Session link sent to Discord successfully and copied to clipboard.")
        else:
            messagebox.showerror("Error", f"Failed to send to Discord: {response.status_code} {response.text}")
    except Exception as e:
        messagebox.showerror("Error", f"An error occurred while sending to Discord: {e}")

def main():
    # Create the main window
    root = tk.Tk()
    root.withdraw()  # Hide the root window

    # Ask if the user wants to use the default webhook URL
    use_default = messagebox.askyesno("Webhook URL", f"Do you want to use the default webhook URL?\n\n{default_webhook_url}")

    if use_default:
        webhook_url = default_webhook_url
    else:
        webhook_url = simpledialog.askstring("Webhook URL", "Please enter the Discord webhook URL:")

    if not webhook_url:
        messagebox.showerror("Error", "Webhook URL is required.")
        return

    while True:
        # Ask for the Live Share session URL
        manual_url = simpledialog.askstring("Live Share Session", "Please enter the Live Share session URL (or type 'exit' to quit):")

        if manual_url is None or manual_url.lower() == 'exit':
            print("Exiting...")
            break

        if manual_url.strip():
            send_to_discord(manual_url.strip(), webhook_url)

if __name__ == "__main__":
    main()
