# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rake db:seed (or created alongside the db with db:setup).
#
# Examples:
#
#   cities = City.create([{ name: 'Chicago' }, { name: 'Copenhagen' }])
#   Mayor.create(name: 'Emanuel', city: cities.first)

usuario = Usuario.create(nome:'Cristian', email: 'c.oliveiradarosa@gmail.com', senha: '123')
usuario.usuario_partidas.new(administrador: 1)
p "@@@@ asads"
partida = Partida.new(descricao:"Jogo de Quinta")
p "#### DEPOIS"
usuario.partidas << partida
usuario.save

12.times do |i|
   partida.jogadors.create(nome:"Jogador #{i}",
	   habilidade: rand(1..5),
	   hab_defesa: rand(1..5),
	   hab_meio:   rand(1..5),
	   hab_ataque: rand(1..5)
   )

end
