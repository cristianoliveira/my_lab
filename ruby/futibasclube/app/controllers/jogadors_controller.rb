class JogadorsController < ApplicationController
  before_action :set_jogador, only: [:show, :edit, :update, :destroy]

  # GET /jogadors
  # GET /jogadors.json
  def index
   
    if !params[:partida_id]
      partida = getPartida
    else
      partida = getUsuarioSessao.partidas.find(params[:partida_id])
      setPartida(partida)

    end

     @jogadors = partida.jogadors.all
  end

  # GET /jogadors/1
  # GET /jogadors/1.json
  def show
  end

  # GET /jogadors/new
  def new
    @jogador = getPartida.jogadors.new
  end

  # GET /jogadors/1/edit
  def edit
  end

  # POST /jogadors
  # POST /jogadors.json
  def create
    @jogador = getPartida.jogadors.new(jogador_params)

    respond_to do |format|
      if @jogador.save
        format.html { redirect_to @jogador, notice: 'Jogador was successfully created.' }
        format.json { render action: 'show', status: :created, location: @jogador }
      else
        format.html { render action: 'new' }
        format.json { render json: @jogador.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /jogadors/1
  # PATCH/PUT /jogadors/1.json
  def update
    respond_to do |format|
      if @jogador.update(jogador_params)
        format.html { redirect_to @jogador, notice: 'Jogador was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @jogador.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /jogadors/1
  # DELETE /jogadors/1.json
  def destroy
    @jogador.destroy
    respond_to do |format|
      format.html { redirect_to jogadors_url }
      format.json { head :no_content }
    end
  end

  private
    # Use callbacks to share common setup or constraints between actions.
    def set_jogador
      @jogador = getPartida.jogadors.find(params[:id])
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def jogador_params
      params.require(:jogador).permit(:partida_id, :nome, :habilidade, :hab_defesa, :hab_meio, :hab_ataque, :telefone, :email, :mensalista, :ativo)
    end

    def setPartida(pPartida)
        session[:partida_id] = pPartida.id 
    end
   
    def getPartida 
        getUsuarioSessao.partidas.find(session[:partida_id])
    end
end
