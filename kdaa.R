# my_rscript.R
#args <- commandArgs(TRUE)
#N <- args[1]
x <- rnorm(1,0,1)
png(filename="C:/xampp/htdocs/SE/temp.png", width=500, height=500)
hist(x, col="lightblue")
dev.off()
