# Terminal color
export PS1="\[\033[36m\]\u\[\033[m\]@\[\033[38;5;164m\]ecv.cours.php:\[\033[34m\]\w \$ \[\033[00m\]"
export LSCOLORS=Exfxcxdxbxegedabagacad
export CLICOLOR=1

HISTCONTROL=ignoreboth

# Alias definitions.
if [ -f ~/.bash_aliases ]; then
    . ~/.bash_aliases
fi

if [ -f ~/.bash_gitlab ]; then
    . ~/.bash_gitlab
fi
