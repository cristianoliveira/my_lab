require 'date'
class PartidasController < ApplicationController
  before_action :set_partida, only: [:show, :edit, :update, :destroy]
  
  # GET /partidas
  # GET /partidas.json
  def index
    @partidas = getUsuarioSessao.partidas.all
    render :layout => "admin" 
  end

  # GET /partidas/1
  # GET /partidas/1.json
  def show
  end

  # GET /partidas/new
  def new
    @partida = getUsuarioSessao.partidas.new
  end

  # GET /partidas/1/edit
  def edit
  end

  # POST /partidas
  # POST /partidas.json
  def create
    @partida = getUsuarioSessao.partidas.new(partida_params)
    respond_to do |format|
      if @partida.save
        getUsuarioSessao.usuario_partidas.create(partida: @partida)
        getUsuarioSessao.save
    
        format.html { redirect_to @partida, notice: 'Partida was successfully created.' }
        format.json { render action: 'show', status: :created, location: @partida }
      else
        format.html { render action: 'new' }
        format.json { render json: @partida.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /partidas/1
  # PATCH/PUT /partidas/1.json
  def update
    p "@@@@@@@@@ TIPO " + params[:tipo]

    respond_to do |format|
      if @partida.update(partida_params)
        format.html { redirect_to @partida, notice: 'Partida was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @partida.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /partidas/1
  # DELETE /partidas/1.json
  def destroy
    @partida.destroy
    respond_to do |format|
      format.html { redirect_to partidas_url }
      format.json { head :no_content }
    end
  end

  def gera_equipes
      
      @partida = getUsuarioSessao.partidas.find(params[:partida_id])
      @equipes = @partida.geraEquipes
      cookies[:equipe_a] = ActiveSupport::JSON.encode(@equipes[0].getJogadoresArray.map{|x| x.id })
      cookies[:equipe_b] = ActiveSupport::JSON.encode(@equipes[1].getJogadoresArray.map{|x| x.id })
       
  end

  def salva_equipes
      hoje = Date.now
      equipeA  = Equipe.new(descricao: "A", data: hoje)
      equipeA.equipes_jogadors.new(data_jogo: hoje) 
      equipeB  = Equipe.new(descricao: "B", data: hoje)
      equipeB.equipes_jogadors.new(data_jogo: hoje)
      
      equipe_a = ActiveSupport::JSON.decode(cookies[:equipe_a])
      equipe_b = ActiveSupport::JSON.decode(cookies[:equipe_b])

      equipe_a.each do |jog_id|
         equipeA.jogadors << Jogador.find(jog_id)
      end

      equipe_b.each do |jog_id|
         equipeB.jogadors << Jogador.find(jog_id)
      end
      
       equipeA.save
       equipeB.save
      
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_partida
      @partida = getUsuarioSessao.partidas.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def partida_params
      params.require(:partida).permit(:usuario_id, :descricao, :tipo, :dia_semana)
    end

end
