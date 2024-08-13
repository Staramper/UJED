import nodemailer from "nodemailer";
import dotenv from "dotenv";
dotenv.config();

const transporter = nodemailer.createTransport({
    host: process.env.MAIL_HOST,
    port: 465,
    secure: true,
    auth: {
        user:process.env.MAIL_USER,
        pass:process.env.MAIL_PASSWORD,
    }
})

export async function enviarMailVerificacion(direccion, token) {
    transporter.sendMail({
        from:"abrahamadlha@gmail.com",
        to: direccion,
        subject: "Verificacion de correo electronico",
        mensaje: token,
    })
}