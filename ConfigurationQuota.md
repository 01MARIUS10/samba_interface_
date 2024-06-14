Pour voir les quotas sur des partages Samba, vous devez vous assurer que les quotas de disque sont configurés sur le système de fichiers sous-jacent, et que Samba est configuré pour respecter ces quotas. Voici les étapes pour vérifier et afficher les quotas via la ligne de commande pour un partage Samba :

### 1. Configurer et Vérifier les Quotas de Disque sur le Système de Fichiers

Assurez-vous que les quotas sont activés sur le système de fichiers où le partage Samba est situé. Voici comment configurer les quotas sur un système Linux :

#### Activer les Quotas
1. Modifiez le fichier `/etc/fstab` pour activer les quotas sur le système de fichiers. Ajoutez les options `usrquota` et `grpquota` à la partition concernée. Par exemple :
    ```fstab
    /dev/sda1  /  ext4  defaults,usrquota,grpquota  0  1
    ```

2. Remontez le système de fichiers pour activer les quotas :
    ```bash
    sudo mount -o remount /dev/sda1
    ```

3. Initialisez les fichiers de quotas :
    ```bash
    sudo quotacheck -cug /dev/sda1
    sudo quotaon -v /dev/sda1
    ```

4. Définissez les quotas pour les utilisateurs ou les groupes :
    ```bash
    sudo edquota -u username
    sudo edquota -g groupname
    ```

### 2. Configurer Samba pour Respecter les Quotas

Samba peut être configuré pour respecter les quotas de disque du système de fichiers. Ajoutez ou modifiez les paramètres dans le fichier de configuration Samba `/etc/samba/smb.conf` pour inclure les quotas :

```ini
[partage]
   path = /chemin/vers/partage
   valid users = @users
   read only = no
   create mask = 0660
   directory mask = 0770
   vfs objects = quota
   quota:backend = tdb
```

### 3. Afficher les Quotas via Samba

Pour afficher les quotas de disque pour un utilisateur spécifique sur un partage Samba, vous pouvez utiliser les commandes suivantes :

#### Utiliser `smbstatus`
La commande `smbstatus` affiche des informations sur les connexions et les fichiers ouverts, mais ne montre pas directement les quotas. Cependant, vous pouvez utiliser les commandes de quotas du système de fichiers pour vérifier les quotas.

#### Utiliser `quota`
La commande `quota` affiche les quotas de disque pour l'utilisateur actuel ou pour un utilisateur spécifié.

##### Pour l'utilisateur actuel :
```bash
quota
```

##### Pour un utilisateur spécifique :
```bash
quota -u username
```

### Exemples Concrets

#### Vérifier les Quotas pour l'Utilisateur Actuel
```bash
quota
```

#### Vérifier les Quotas pour un Utilisateur Spécifique
```bash
quota -u alice
```

#### Vérifier les Quotas pour un Groupe Spécifique
```bash
quota -g groupname
```

### Notes Supplémentaires
- Assurez-vous que les services Samba sont redémarrés après avoir modifié le fichier de configuration :
  ```bash
  sudo systemctl restart smbd
  sudo systemctl restart nmbd
  ```

- La commande `quota` doit être exécutée avec des privilèges suffisants pour voir les informations de quotas des autres utilisateurs.

En suivant ces étapes, vous pourrez configurer et vérifier les quotas de disque pour les partages Samba sur votre système.