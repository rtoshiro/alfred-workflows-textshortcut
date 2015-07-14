# alfred-workflows-textshortcut

---

#### Version 1.1 - Terminal Commands added!

---

Workflow for Alfred 2 to abbreviate some texts (snippets) and save some terminal commands.

Just type:

`ts [shortcut name]` (for Snippet list)

![ts](./readme/01.jpg)

or 

`tc [shortcut name]` (for Command list)

![tc](./readme/02.jpg)

## Adding new shortcut (or terminal commands):

First, cmd+c (copy) text (or command) you want to use

Then, type:

`ts add [shortcut name]` (or "**tc**", for commands)

After that, you can type:

`ts [shortcut name]` (or "**tc**", for commands)

If you have used "ts", the snippet will be pasted.

If you have used "tc", the command will be executed. 

If the command should run using Administrative Privilegies, you should put the word "**sudo**" before the command you would like to execute.

That is all!

## Removing shortcut (or terminal commands):

Just type:

`ts del [shortcut name]` (or "**tc**", for commands)

If dont remember the shortcut name, just type: `ts del` and all shortcuts will be displayed.

## See some examples:

copy: 

"Best regards, Jon Doe"

`ts add me`

When you are writing an email, type:

`ts me`

TS will paste: "Best regards, Jon Doe"


And, if you can help me, please donate => <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=rtoshiro%40gmail%2ecom&lc=US&item_name=Toshiro&no_note=0&currency_code=BRL&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest"><img border="0" alt="Visualizar imagem" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" /></a>
