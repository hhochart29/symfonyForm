# MAC OS .bash_aliases

# Navigation
alias ..="cd .."
alias ...="cd ../.."
alias ....="cd ../../.."
alias .....="cd ../../../.."

alias la='ls -la'
alias l='ls -la'
alias lsa='ls -A'           # affiche les fichiers cachés
alias ll='ls -lh'           # affiche en mode liste détail
alias lla='ls -Al'          # affiche en mode liste détail + fichiers cachés
alias lk='ls -lSr'          # tri par taille, le plus lourd à la fin
alias lc='ls -ltcr'         # tri par date de modification, la pus récente à la fin
alias lu='ls -ltur'         # tri par date d’accès, la pus récente à la fin
alias lt='ls -ltr'          # tri par date, la pus récente à la fin
alias lm='ls -al | more'    # Pipe a travers 'more'
alias lr='ls -lR'           # ls récursif

# Rapidité ou fainéantise
alias h='history'
alias g='grep'
alias hg='history | grep'
