#!/bin/bash

# Vérifier si au moins deux arguments ont été passés
if [ $# -lt 2 ]; then
    echo "Usage: $0 <username> <password>"
    exit 1
fi

# Utiliser le premier argument comme nom d'utilisateur
USERNAME=$1

# Vérifier si le nom d'utilisateur est vide
if [[ -z "$USERNAME" ]]; then
    echo "Error: Username cannot be empty."
    exit 1
fi

# Utiliser le deuxième argument comme mot de passe
PASSWORD=$2

# Ajouter l'utilisateur Samba
echo "Ajout de l'utilisateur Samba $USERNAME..."
sudo smbpasswd -a "$USERNAME"

# Définir le mot de passe de l'utilisateur Samba
echo "Définition du mot de passe pour $USERNAME..."
echo "$PASSWORD" | sudo smbpasswd -e "$USERNAME"

echo "L'utilisateur Samba $USERNAME a été ajouté avec succès."
